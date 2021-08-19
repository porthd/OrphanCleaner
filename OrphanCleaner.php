<?php
declare(strict_types=1);

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2021 Dr. Dieter Porth <info@mobger.de>
 *
 *  All rights reserved
 *
 *  This script is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Before using the script on the command line, you have to change the name of the PHP file.
 * If you can change the name, then you probably also have the rights to access the files in the folder.
 *
 * Call up in the console after renaming to OrphanCleanerNeu.php
 * php <path-to-file> / NeuOrphanCleaner --start =. / --linker = css, txt, html, sass, less, php, js, md --marker = png, gif, tif, tiff, jpeg, webp, bmp, svg --archive = <name-of-archive-folder-without-timestamp>
 *
 * all required
 *
 * --start = start directory of search.
 * --linker = list of file extension, which contain links to files via the name of the file plus its extension. No whitespace allowed. (default = 'css, txt, html, sass, less, php, js, md'
 * --marker = list of file extensions. The extension marks the files as orphans, which should be removed, if the are not used by the resources. No whitespace allowed.
 * --archive = start name of archive file with moved files (optional; default =)
 */

define('CLEANER_DEFAULT_MOD_DIR', 755);
define('CLEANER_DEFAULT_LINKER_LIST', ['css', 'txt', 'html', 'sass', 'less', 'php', 'js', 'md']);
define('CLEANER_DEFAULT_MAPPER_LIST', ['m4p','mp3','ogg','wav','wmv','mov','avi','png', 'gif', 'tif', 'tiff', 'jpeg', 'webp', 'bmp', 'svg', 'pdf', 'ppt', 'docx', 'xls', 'doc', 'txt']);
define('CLEANER_DEFAULT_ARCHIVE_NAME', 'archive');
call_user_func(
    function ($myArgv) {

        $defaultArchiveName = 'archive';


        function myEcho($message): void
        {
            echo $message;
        }

        function killProcessIfParameterFails(array $arguments): array
        {
            if (count($arguments) > 5) {
                die('Wrong count of parameters: There must between one and five parameters. ');
            }
            $startName = getcwd();
            $linkerList = CLEANER_DEFAULT_LINKER_LIST;
            $markerList = CLEANER_DEFAULT_MAPPER_LIST;
            $archiveName = CLEANER_DEFAULT_ARCHIVE_NAME;
            $flagStart = false;
            $flagLinker = false;
            $flagMarker = false;
            $flagArchive = false;
            unset($arguments[0]);
            foreach ($arguments as $value) {
                $parts = explode('=', $value, 2);
                if (count($parts) == 2) {

                    switch ($parts[0]) {
                        case '--start' :
                            if ($flagStart) {
                                myEcho('Warning: The start-name `' . $startName . '` will be overridden, because it is doubled.' . "\n");
                            }
                            $check = trim($parts[1]);
                            $flagStart = $flagStart || (!empty($check));
                            $startName = ((!empty($check)) ?
                                $check :
                                $startName);
                            break;
                        case '--linker' :
                            if ($flagLinker) {
                                myEcho('Warning: The linkerlist `' . print_r($linkerList) . '` will be overridden, because it is doubled.' . "\n");
                            }
                            $checkRaw = trim($parts[1]);
                            $check = preg_replace('/\s+/', '', $checkRaw);
                            $check = str_replace('.', '', $check);
                            $flagLinker = $flagLinker || ((!empty($check)) && ($check === $checkRaw));
                            if (!$flagLinker) {
                                die('The parameter for linkerlist `' . $checkRaw . '` failed. Whitespaces and dots are not allowed in the comma-separeted list. A space after `=` will turn to an empty list, which is not allowed.' . "\n");
                            }
                            $linkerList = explode(',', $check);
                            break;
                        case '--marker' :
                            if ($flagMarker) {
                                myEcho('Warning: The markerlist `' . print_r($markerList) . '` will be overridden, because it is doubled.' . "\n");
                            }
                            $checkRaw = trim($parts[1]);
                            $check = preg_replace('/\s+/', '', $checkRaw);
                            $check = str_replace('.', '', $check);
                            $flagMarker = $flagMarker || ((!empty($check)) && ($check === $checkRaw));
                            if (!$flagMarker) {
                                die('The parameter for markerlist `' . $checkRaw . '` failed. Whitespaces and dots are not allowed in the comma-separeted list. A space after `=` will turn to an empty list, which is not allowed.' . "\n");
                            }
                            $markerList = explode(',', $check);
                            break;
                        case '--archive' :
                            if ($flagArchive) {
                                myEcho('Warning: The archive-name `' . $archiveName . '` will be overridden, because it is doubled.' . "\n");
                            }
                            $check = trim($parts[1]);
                            $flagArchive = $flagArchive || (!empty($check));
                            $archiveName = ((!empty($check)) ?
                                $check :
                                $archiveName);
                            break;
                        default:
                            myEcho('Warning: The value `` is not used. Please remove it.' . "\n");
                            break;
                    }
                } else {
                    myEcho('Warning: The value `' . $value . '` did not contain an equual-sign `=`.' . "\n");
                }
            }
            return [$startName, $linkerList, $markerList, $archiveName];

        }

        function transformToAbsPathOrKillOnError($startName, $archiveName)
        {
            if (strpos($startName, DIRECTORY_SEPARATOR) === 0) {
                if (!is_dir($startName)) {
                    die('The folder defined in `start` (' . $startName . ') starts with `' . DIRECTORY_SEPARATOR .
                        '` and seems to be an absolute path (. The directory  dont exist. ');
                }
                $absStartPath = $startName;
            } else {
                $absStartPath = $startName . DIRECTORY_SEPARATOR ;
                if (!is_dir($absStartPath)) {
                    die('The folder defined in `start` (' . $startName . ') must be defined relatively ' .
                        'to the work-folder `' . getcwd() . '`. That folder `' . $absStartPath .
                        '` does not exist. Check the spellings and your userrights.');
                }
                $absStartPath = realpath($absStartPath);
            }
            // generade a readable and sortable timestamp for the prefix
            $prefixStamp = (new DateTime('now'))->format('Ymd-His-');
            $count = '';
            $rawArchivePath = $absStartPath . DIRECTORY_SEPARATOR . $prefixStamp . $archiveName;
            do {
                $absArchivePath = $rawArchivePath . $count;
                $count++;
            } while (is_dir($absArchivePath));

            if (!mkdir($absArchivePath, CLEANER_DEFAULT_MOD_DIR, true) && !is_dir($absArchivePath)) {
                die('The archive-folder `' . $absArchivePath . '` could not be created. Check the user-rights.');
            }
            return [$absStartPath, $absArchivePath];
        }

        function findRecursiveAllFileByExt(
            $folder,
            &$orphanExt,
            &$files
        ): void {
            if ((is_dir($folder)) && ($handle = opendir($folder))) {
                while (($name = readdir($handle)) !== false) {
                    if (($name !== '.') &&
                        ($name !== '..')
                    ) {
                        if (is_dir($folder . DIRECTORY_SEPARATOR . $name)) {
                            findRecursiveAllFileByExt(
                                $folder . DIRECTORY_SEPARATOR . $name,
                                $orphanExt,
                                $files
                            );
                        } else {
                            $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
                            if (in_array($ext,$orphanExt)) {
                                $files[] = $folder . DIRECTORY_SEPARATOR . $name;
                            }
                        }
                    }
                }

                closedir($handle);
            }
        }

        function reduceToFileName($listOfFilePath = [])
        {
            $result = [];
            if (!empty($listOfFilePath)) {
                foreach ($listOfFilePath as $filePath) {
                    $info = pathinfo($filePath);
                    if (isset($result[$info['basename']])) {
                        // different pathes but same filename
                        $result[$info['basename']][] = $filePath;
                    } else {
                        $result[$info['basename']] = [$filePath];
                    }
                }
            }
            return $result;
        }

        function parseFilesForNames($listOfLinkerFile, $listOfResonrceNames)
        {
            if (empty($listOfLinkerFile)) {
                die('There is no file, which will check the orphans. The orphan-file are move into `' .
                    CLEANER_DEFAULT_ARCHIVE_NAME . '`');
            }
            foreach ($listOfLinkerFile as $fileName) {
                $test = file_get_contents($fileName);
                // reduce the list, if one value of the list is contained in the testStream
                $listOfResonrceNames = array_filter(
                    $listOfResonrceNames,
                    function ($v) use ($test) {
                        return (strpos($test, $v) === false);
                    }
                );
                unset($test);
            }
            return $listOfResonrceNames;
        }

        function moveFileToArchive(
            string $startFolder,
            string $archiveFolder,
            array $reduceNameList,
            array $listResource
        ) {
            $startFolderLength = strlen($startFolder);
            foreach ($reduceNameList as $key) {
                if (!empty($listResource[$key])) {
                    foreach ($listResource[$key] as $filePath) {
                        $sourcePath = $filePath;
                        if (!file_exists($sourcePath)) {
                            myEcho('WARNING-WARNING: There file `' . $filePath . '` is no longer avaibale in the folder `' . $startFolder .
                                '`. There may work other processes, which have removed the file.`');
                        } else {
                            $reducedFilePath = substr($filePath, $startFolderLength);
                            $pathInfo = pathinfo($reducedFilePath);
                            $destPath = $archiveFolder . $pathInfo['dirname']. DIRECTORY_SEPARATOR ;
                            if (!is_dir($destPath)) {
                                if ((!mkdir($destPath, CLEANER_DEFAULT_MOD_DIR, true)) &&
                                    (!is_dir($destPath))
                                ) {
                                    die('The creation of the folder `'.$destPath.'` failed. A file with the same name exists.');
                                }
                            }
                            $destPathFile = $destPath.$pathInfo['basename'];
                            if (!rename($sourcePath, $destPathFile)) {
                                myEcho('WARNING-WARNING: There file `' . $sourcePath . '` could not renamed to `' . $destPath .
                                    '`. Check the Rights of the Source-file. Perhaps there are parallel processes, which disturb the current process.');

                            }
                        }
                    }
                }
            }
        }

        function parseOrphanFilesinCode(
            string $startFolder,
            array $linkerList,
            array $orphanExtList,
            string $archiveFolder
        ) {
            $listResourceRaw = [];
            findRecursiveAllFileByExt($startFolder, $orphanExtList, $listResourceRaw);
            $listResource = reduceToFileName($listResourceRaw);
            $resourceFileList = array_keys($listResource);
            $linkerFileList = [];
            findRecursiveAllFileByExt($startFolder, $linkerList, $linkerFileList);
            $reduceNameList = parseFilesForNames($linkerFileList, $resourceFileList);
            moveFileToArchive($startFolder, $archiveFolder, $reduceNameList, $listResource);
        }

        // Parse
        try {
            [$startName, $linkerList, $markerList, $archiveName] = killProcessIfParameterFails(
                $myArgv
            );
            [$absStartPath, $absArchivePath] = transformToAbsPathOrKillOnError($startName, $archiveName);
            parseOrphanFilesinCode($absStartPath, $linkerList, $markerList, $absArchivePath);
        } catch (\Exception $e) {
            die('The removing of orphan-files could not successfully solved. An exception was thrown. ' .
                'The message was:' . $e->getMessage());
        }

        die('Your cleanup was succesful. The orphan-file are move into `' . $defaultArchiveName . '`');
    },
    $argv // not options, only use the raw Arguments
);
