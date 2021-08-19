# Process `OrphanCleaner` (German translated by Google)
# Process `OrphanCleaner` (German)
# !!!!!!!!!!!!!! WARNING: Never use on publicly accessible sites WARNING !!!!!!!!!!!!!!!

## Generally
### abstract
The script moves all `orphan` files with certain` Marker` extensions under a `Start` folder to an` Archive` folder, if these marker files are not mentioned in files with a `Linker` extension.
### What is the PHP file doing?
The program records all files that have one of the extensions specified for `--marker =`.
The files must be in the folder specified for `--start =`. Either an absolute file path (beginning with `/`) or a relative file path must be specified.
The program checks whether the names of the recorded files including their extensions appear as text in at least one link file. The link files include all files with an extension from the list `--linker =`.
All files found in the linker files are moved to an archive folder.
## Technically
### Preparation
1. Renaming is no longer necessary as it does not offer any real additional protection.
### parameters
The file knows 4 parameters.
* --Begin
    * Standard: Directory of the call
    * Function: Specify the relative or absolute path for file processing.
* --linker
    * Default:
    * Function: Comma-separated list of files that can contain the file name as text or in a link text.
* --marker
    * Default:
    * Function: Comma-separated list of files that can contain the file name as text or in a link text.
* --Archive
    * Standard: archive
    * Function: Part of the name of the folder to which unused files are moved.
      The complete folder name consists of a date-time code, the name given here and a number.
      E.g. on 08/15/2021 at 3:53:21 pm it would look like this: `20210815-155324-archive_0 /`.

## Go to website
The page can also be accessed via the browser.
Just put the entire folder somewhere in a web directory and open the file `WebOrphanCleaner.php` with the browser.

`https: // dueddelei.ddev.site / typo3conf / ext / webhelp / Cleaner / WebOrphanCleaner.php`
or `https: // <domain address> / <folder from the webroot directory> / WebOrphanCleaner.php`
Enter the folder to be cleaned with its absolute folder address or with `` ../ '' as the folder address relative to the folder of `` WebOrphanCleaner.php ''.

The meaning of the input fields is the same as described above.

## Start test in console
1.Open the console ((Bash, PowerShell, ...)
2. Use the command `cd` to go to the folder of this file` ReadMe.md`.
3. The availability of php7.3 + in the command line is assumed.
4. Run the following command to start the test
   ``
   $> php --start =
   ``
## Check the checklist for the test
1. There must be a new order. Its name should consist of a date prefix (year, month, date, hour, minute, second), the word `archive` and a number.
2. Only files containing the word 'test' should be found in the folder.
   (Since the case sensitivity of individual operating systems is treated differently, the aspect of the upper and lower case is not considered here.)
3. No files named Test should be found in the other folder of these directories.

### Repetition / dismantling of the test environment
1. Copy the into the current folder.
   You should now be back to the previous structure.
2. Delete the archive folder.
3. Start the test process again. You enter the various parameters at your own risk.
   (Back up your important data regularly and especially before introducing an update or new ~~ Juice ~~ software.)

## Note for the clean code bullies and the test-driven police
The author only ran the test with `` $> php --start = ''.
Everyone has to know for themselves what they are doing.
I am grateful for any references to bugs and / or spelling mistakes.