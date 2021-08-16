# Process `Cleaner` (German)
## General
### What is the PHP file doing
The program records all files that have one of the extensions specified for `--marker =`.
The files must be in the folder that was specified for `--start =`. Either an absolute file path (beginning with `/`) or a relative file path must be specified.
The program checks whether the names of the files recorded, including their extensions, appear as text in at least one link file. The link files include any file that has an extension from the list `--linker =`.
All files found in the linker files are moved to an archive folder.
## Technical
### Preparation
1. Rename the file so that you can use it. The string `OrphanCleaner.php` must not appear in the name. (Preventing Abuse)
### parameters
The file knows 4 parameters.
* --begin
    * Default: directory of the call
    * Function: Specify relative or absolute path for file processing.
* --linker
    * Default:
    * Function: Comma-separated list with files that could contain the file name as text or in a link text.
* --marker
    * Default:
    * Function: Comma-separated list with files that could contain the file name as text or in a link text.
* --archive
    * Default: archive
    * Function: Part name of the folder into which unused files are moved.
      The full folder name consists of a date-time code, the name mentioned here and a number.
      For example, on Aug. 15, 2021 at 15:53:21 it would look like this: `20210815-155324-archive_0 /`.

## Start test in console
1. Open the console ((Bash, PowerShell, ...)
2. Use the `cd` command to go to the folder of this` ReadMe.md` file.
3. The availability of php7.3 + in the command line is assumed.
4. Call the following command to start the test
   ``
   $> php --start =
   ``
## Check checklist for test
1. A new order must exist. Its name should consist of a date prefix (year, month, date hour, minute, second), the word `archive` and a number.
2. Only files containing the word 'test' should be found in the folder.
   (Since the upper and lower case is treated differently by individual operating systems, the upper and lower case aspect is not taken into account here.)
3. In the other folder, these directories, no files with the name Test should be found.

### Repetition / dismantling of the test environment
1. Copy the into the present folder.
   You should now have the previous structure again.
2. Delete the archive folder.
3. Start the test process again. You enter the various parameters at your own risk.
   (Back up your important data regularly and especially before introducing an update or a new ~~ juice ~~ software.)

## Note for the clean code bullies and test-driven police
The author only ran the test with `` $> php --start = ''.
Everyone has to know for themselves what they are doing.
I am grateful for any information about program errors and / or spelling errors.
