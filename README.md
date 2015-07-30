# pfSense-user-xml-generator

## What does it do?

Allows uploading of cvs files that can later be read and converted into XML the XML that defines users in a **pfSense v2.2.4** server.

## Dependencies

PHP server with write access to allow file upload

## Installation

Clone or download the files into a writable folder on your server where they can be served.

## File format

File must be csv with the one user per line, considering the following fields

- Username
- Password
- Description

### Example file

```
guest1,password,Guest Account
guest2,password,Guest Account

```

## Usage

### Finding the info

Create a backup file of your pfSence server, an XML file will be created


Go to your backup file and find the line nextuid (the number will probably be different):

```xml
<nextuid>2005</nextuid>
```

Remember the value as you'll use it later.

### Browser

Point your browser to the url where the files are, for example: [http://localhost/pfsense-user-xml](http://localhost/pfsense-user-xml)

### File upload

A form that allows you to upload files will appear. In here, either upload a file if you havent already or if you have one, click on the link below the form.

### Options

You'll be redirected to another page where config options can be set:

|Option         | Description                                                                                           |
|:--------------|:------------------------------------------------------------------------------------------------------|
| csv file      | The file to be parsed into XML                                                                        |
| Next uid      | Sets the starting uid to be used (&lt;nextuid> in config file, the value should go here )             |
| Output Format | Whether the output should be rendered in HTML or not (allowing source to be formatted in page source) |

Select the options that you want and submit the form

### Output

Depending on how you selected the output to be displayed, consideing a file above, you'll see one of the following:

**Escaped**

```xml
<user>
<scope>user</scope>
<password>$1$PbrsavF.$Ubu5wIR3TQudNIOUD0Ni31</password>
<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
<name>guest1</name>
<descr><![CDATA[Guest Account]]></descr>
<expires/>
<authorizedkeys/>
<ipsecpsk/>
<uid>2005</uid>
</user>
<user>
<scope>user</scope>
<password>$1$8CvsKJMY$JK.RxVonf5CM/8X2JKTyZ/</password>
<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
<name>guest2</name>
<descr><![CDATA[Guest Account]]></descr>
<expires/>
<authorizedkeys/>
<ipsecpsk/>
<uid>2006</uid>
</user>
```

**Page source**

```
user $1$KHnqLaEh$6d.6Auk8X1i2bWA0tVrs0/ 5f4dcc3b5aa765d61d8327deb882cf99 3339393332663466623061306161366535316337636639383233633264303137 guest1 2005 user $1$kb/DakSr$FokGkGFxUedCo829QndRN/ 5f4dcc3b5aa765d61d8327deb882cf99 3339393332663466623061306161366535316337636639383233633264303137 guest2 2006
```

If you then view page source (usually right click => view source) you'll then see a nicely formatted xml:

```xml
		<user>
			<scope>user</scope>
			<password>$1$KHnqLaEh$6d.6Auk8X1i2bWA0tVrs0/</password>
			<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
			<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
			<name>guest1</name>
			<descr><![CDATA[Guest Account]]></descr>
			<expires/>
			<authorizedkeys/>
			<ipsecpsk/>
			<uid>2005</uid>
		</user>
		<user>
			<scope>user</scope>
			<password>$1$kb/DakSr$FokGkGFxUedCo829QndRN/</password>
			<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
			<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
			<name>guest2</name>
			<descr><![CDATA[Guest Account]]></descr>
			<expires/>
			<authorizedkeys/>
			<ipsecpsk/>
			<uid>2006</uid>
		</user>
```

### Adding Users

Copy the XML that was generated,go to your backup file and find the line nextuid:

```xml
<nextuid>2005</nextuid>
```

Change the number to last user's uid plus one, in the example 2006 + 1 = 2007
```xml
<nextuid>2007</nextuid>
```

Paste the users XML just above it:
```xml
....
		<user>
			<scope>user</scope>
			<password>$1$KHnqLaEh$6d.6Auk8X1i2bWA0tVrs0/</password>
			<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
			<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
			<name>guest1</name>
			<descr><![CDATA[Guest Account]]></descr>
			<expires/>
			<authorizedkeys/>
			<ipsecpsk/>
			<uid>2005</uid>
		</user>
		<user>
			<scope>user</scope>
			<password>$1$kb/DakSr$FokGkGFxUedCo829QndRN/</password>
			<md5-hash>5f4dcc3b5aa765d61d8327deb882cf99</md5-hash>
			<nt-hash>3339393332663466623061306161366535316337636639383233633264303137</nt-hash>
			<name>guest2</name>
			<descr><![CDATA[Guest Account]]></descr>
			<expires/>
			<authorizedkeys/>
			<ipsecpsk/>
			<uid>2006</uid>
		</user>
		<nextuid>2007</nextuid>
....
```

### Restore backup

Load the backup back to pfSense and wait a bit for the config to be loaded, your users should be in there (**without groups**)

## Important notes

Make sure you copy the XML with the starting &lt; and ending &gt;

Users created this way are NOT assigned to any group

Lines that do not match the format are skipped

## License

Licensed under the GPL license.
