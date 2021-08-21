# Process `OrphanCleaner` (German)
# !!!!!!! WARNING: Never use on publicly available sites! WARNING !!!!!!!

## General
### abstract
The script moves all `orphan` files with certain `marker` extensions under a `start` folder into an `orphan` folder,
if these marker files were never mentioned in files with the `inker` extension.
The files including the folder structures are not lost after being moved.

### What does the php file `OrphanCleaner.php` do
The php program records all files that have one of the extensions specified in `--marker =` in their file names.
The files must be in the folder whose absolute or relative file path was specified with `--start =`.
An absolute file path begins with `/`. The relative file path begins with a letter or `../` and means a folder relative to the current file.
The program checks whether the names of the recorded files, including their extensions, appear as text in at least one linker file.
Linker-files include any file that has an extension from the list `--linker =`.
All files with a marker extension whose names were not found in the linker-files are moved to the folder for the orphan-files.

### What does the php file `WebOrphanCleaner.php` do
The file `WebOrphanCleaner.php` creates a website with an input form,
that asks the parameters for the console program `OrphanCleaner.php`.
After entering the result of the mental arithmetic and submitting the form
`OrphanCleaner.php` is called and executed.
`WebOrphanCleaner.php` is the GUI (Ingenious Unneeded Inspection) by` OrphanCleaner.php`

## Technical
### folder `.ddev`
I use [DDEV](https://ddev.readthedocs.io/en/stable/) as a local development environment, which is based on [Docker](https://www.docker.com/products/docker-desktop).
The folder contains the used configuration.

### Preparation
1. Note about the old version: The renaming is no longer necessary because it does not offer any real additional protection.
2. The website `WebOrphanCleaner.php` assumes that the php main program` OrphanCleaner.php` is in the same folder as it.
3. The main program can also be called via the operating system in a console/terminal/bash/command line input.

### Parameters
The main program like the web form knows 4 parameters.
* --begin
    * Default: directory of the call
    * Function: Specify relative or absolute path for file processing.
* --linker
    * Default:
    * Function: Comma-separated list with files that could contain the file name as text or in a link text.
* --marker
    * Default:
    * Function: Comma-separated list with files that could contain the file name as text or in a link text.
* --orphans
    * Default: orphans
    * Function: Part of the name of the folder to which unused files are moved.
      The full folder name consists of a date-time code, the name mentioned here and a number.
      For example, on Aug. 15, 2021 at 15:53:21 it would look like this: `20210815-155324-orphans_0 /`.

In the web form you still have to fill in the field with the ultimate calculation for the question of all questions, so that the main program can be started. (Protection against the fact that the finger clicks faster than the developer can think.)

### The moved files
Each time it is called, a folder for the orphans is created in the start folder with a date in its name.
The orphaned files are moved to this folder while maintaining their relative folder structure.
The second time it is called up, of course, the folder for the orphans is also searched for orphaned files.


## Call up as a website
Simply put the entire folder somewhere in a web directory and open the file `WebOrphanCleaner.php` in your browser.

Example:
`https: // dueddelei.ddev.site/typo3conf/ext/webhelp/Cleaner/WebOrphanCleaner.php`
or `https: // <domain address>/<folder from webroot directory>/WebOrphanCleaner.php`

Enter the folder to be cleaned up with its absolute folder address or with `../` as a path relative to the folder of `WebOrphanCleaner.php`.

The meaning of the input fields is the same as described above or on the website.

## test
## Start tests of `OrphanCleaner.php` in console
1. Open the console ((Bash, PowerShell, ...)
2. Use the `cd` command to go to the folder of this` ReadMe.md` file.
3. The availability of php7.3 + in the command line is assumed.
4. Call the following command to start the test

```
   $> php --start =
```

### Check checklist for test
1. A new folder must exist. Its name should consist of a date (`YearMonthDay-HourMinuteSecond-`),
   consist of the word `orphan` and a number.
2. Only files containing the word 'test' should be found in the folder.
   (Since the upper and lower case is treated differently by individual operating systems, the upper and lower case aspect is not taken into account here.)
3. In the other folder these directories, no files with the name `Test` should be found.

### Repetition/dismantling of the test environment
1. Copy the into the present folder.
   You should now have the previous structure again.
2. Delete the folder for the orphan-files.
3. Start the test process again. You enter the various parameters at your own risk.
   (Back up your important data regularly and especially before introducing an update or a new ~~ juice ~~ software.)

## Note for the clean code bullies and test-driven police
The author only ran the test with `$> php --start = ''`.
The program can fail on certain operating systems if, for example, the php has insufficient rights or if there are discrepancies in the upper case or ...

### Principle: My name is Rabbit and I don't know anything.
Everyone has to know for themselves what they are doing.
I am grateful for any references to program errors and/or spelling errors.

##copyright
(c) 2021 Dr. Dieter Porth <info@mobger.de> (PHP-Programming)
(c) 2021 Bartosz Skowronek (Design/Frontend)
