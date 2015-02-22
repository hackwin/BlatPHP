<?php

// Jesse Campbell
// 2015-02-21
// www.jbcse.com

// PHP Wrapper for sending emails from Blat
// Blat is a command-line email client
// Requirements: PHP, Blat, stunnel (if your SMTP server uses SSL)
// Windows only

/*
Blat v2.5.0 w/GSS encryption (build : Sep 14 2005 22:46:29)

Win32 console utility to send mail via SMTP or post to usenet via NNTP
by P.Mendes,M.Neal,G.Vollant,T.Charron,T.Musson,H.Pesonen,A.Donchey,C.Hyde
  http://www.blat.net
syntax:
  Blat <filename> -to <recipient> [optional switches (see below)]
  Blat -install <server addr> <sender's addr> [<try>[<port>[<profile>]]] [-q]
  Blat -profile [-delete | "<default>"] [profile1] [profileN] [-q]
  Blat -h

-------------------------------- Installation ---------------------------------
-install[SMTP|NNTP|POP3] <server addr> <sender's email addr> [<try n times>
                [<port> [<profile> [<username> [<password>]]]]]
                : set server, sender, number of tries and port for profile
                  (<try n times> and <port> may be replaced by '-')
                  port defaults are SMTP=25, NNTP=119, POP3=110
                  default profile can be specified with a '-'
                  username and/or password may be stored to the registry
                  order of options is specific
                  use -installNNTP for storing NNTP information
                  use -installPOP3 for storing POP3 information
                      (sender and try are ignored, use '-' in place of these)

--------------------------------- The Basics ----------------------------------
<filename>      : file with the message body to be sent
                  if your message body is on the command line, use a hyphen (-)
                  as your first argument, and -body followed by your message
                  if your message will come from the console/keyboard, use the
                  hyphen as your first argument, but do not use -body option.
-of <file>      : text file containing more options (also -optionfile)
-to <recipient> : recipient list (also -t) (comma separated)
-tf <file>      : recipient list filename
-cc <recipient> : carbon copy recipient list (also -c) (comma separated)
-cf <file>      : cc recipient list filename
-bcc <recipient>: blind carbon copy recipient list (also -b)
                  (comma separated)
-bf <file>      : bcc recipient list filename
-maxNames <x>   : send to groups of <x> number of recipients
-ur             : set To: header to Undisclosed Recipients if not using the
                  -to and -cc options
-subject <subj> : subject line, surround with quotes to include spaces(also -s)
-ss             : suppress subject line if not defined
-sf <file>      : file containing subject line
-body <text>    : message body, surround with quotes to include spaces
-sig <file>     : text file containing your email signature
-tag <file>     : text file containing taglines, to be randomly chosen
-ps <file>      : final message text, possibly for unsubscribe instructions

----------------------------- Registry overrides ------------------------------
-p <profile>    : send with server, user, and port defined in <profile>
                : use username and password if defined in <profile>
-profile        : list all profiles in the Registry
-server <addr>  : specify SMTP server to be used (optionally, addr:port)
-serverSMTP <addr>
                : same as -server
-serverNNTP <addr>
                : specify NNTP server to be used (optionally, addr:port)
-serverPOP3 <addr>
                : specify POP3 server to be used (optionally, addr:port)
                  when POP3 access is required before sending email
-f <sender>     : override the default sender address (must be known to server)
-i <addr>       : a 'From:' address, not necessarily known to the server
-port <port>    : port to be used on the SMTP server, defaults to SMTP (25)
-portSMTP <port>: same as -port
-portNNTP <port>: port to be used on the NNTP server, defaults to NNTP (119)
-portPOP3 <port>: port to be used on the POP3 server, defaults to POP3 (110)
-u <username>   : username for AUTH LOGIN (use with -pw)
-pw <password>  : password for AUTH LOGIN (use with -u)
-pu <username>  : username for POP3 LOGIN (use with -ppw)
-ppw <password> : password for POP3 LOGIN (use with -pu)

---------------------- Miscellaneous RFC header switches ----------------------
-organization <organization>
                : Organization field (also -o and -org)
-ua             : include User-Agent header line instead of X-Mailer
-x <X-Header: detail>
                : custom 'X-' header.  eg: -x "X-INFO: Blat is Great!"
-noh            : prevent X-Mailer/User-Agent header from showing Blat homepage
-noh2           : prevent X-Mailer header entirely
-d              : request disposition notification
-r              : request return receipt
-charset <cs>   : user defined charset.  The default is ISO-8859-1
-a1 <header>    : add custom header line at the end of the regular headers
-a2 <header>    : same as -a1, for a second custom header line
-dsn <nsfd>     : use Delivery Status Notifications (RFC 3461)
                  n = never, s = successful, f = failure, d = delayed
                  can be used together, however N takes precedence
-hdrencb        : use base64 for encoding headers, if necessary
-hdrencq        : use quoted-printable for encoding headers, if necessary
-priority <pr>  : set message priority 0 for low, 1 for high

----------------------- Attachment and encoding options -----------------------
-attach <file>  : attach binary file(s) to message (filenames comma separated)
-attacht <file> : attach text file(s) to message (filenames comma separated)
-attachi <file> : attach text file(s) as INLINE (filenames comma separated)
-embed <file>   : embed file(s) in HTML.  Object tag in HTML must specify
                  content-id using cid: tag.  eg: <img src="cid:image.jpg">
-af <file>      : file containing list of binary file(s) to attach (comma
                  separated)
-atf <file>     : file containing list of text file(s) to attach (comma
                  separated)
-aef <file>     : file containing list of embed file(s) to attach (comma
                  separated)
-base64         : send binary files using base64 (binary MIME)
-uuencode       : send binary files UUEncoded
-enriched       : send an enriched text message (Content-Type=text/enriched)
-unicode        : message body is in 16- or 32-bit Unicode format
-html           : send an HTML message (Content-Type=text/html)
-alttext <text> : plain text for use as alternate text
-alttextf <file>: plain text file for use as alternate text
-mime           : MIME Quoted-Printable Content-Transfer-Encoding
-8bitmime       : ask for 8bit data support when sending MIME
-multipart <size>
                : send multipart messages, breaking attachments on <size>
                  KB boundaries, where <size> is per 1000 bytes
-nomps                : do not allow multipart messages

---------------------------- NNTP specific options ----------------------------
-groups <usenet groups>
                : list of newsgroups (comma separated)

-------------------------------- Other options --------------------------------
-h              : displays this help (also -?, /?, -help or /help)
-q              : suppresses all output to the screen
-debug          : echoes server communications to a log file or screen
                  (overrides -q if echoes to the screen)
-log <file>     : log everything but usage to <file>
-timestamp      : when -log is used, a timestamp is added to each log line
-ti <n>         : set timeout to 'n' seconds.  Blat will wait 'n' seconds for
                  server responses
-try <n times>  : how many times blat should try to send (1 to 'INFINITE')
-binary         : do not convert ASCII | (pipe, 0x7c) to CrLf in the message
                  body
-hostname <hst> : select the hostname used to send the message via SMTP
                  this is typically your local machine name
-raw            : do not add CR/LF after headers
-delay <x>      : wait x seconds between messages being sent when used with
                  -maxnames or -multipart
-comment <char> : use this character to mark the start of commments in
                  options files and recipient list files.  The default is ;
-superdebug     : hex/ascii dump the data between Blat and the server
-superdebugT    : ascii dump the data between Blat and the server
-------------------------------------------------------------------------------

Note that if the '-i' option is used, <sender> is included in 'Reply-to:'
and 'Sender:' fields in the header of the message.

Optionally, the following options can be used instead of the -f and -i
options:

-mailfrom <addr>   The RFC 821 MAIL From: statement
-from <addr>       The RFC 822 From: statement
-replyto <addr>    The RFC 822 Reply-To: statement
-returnpath <addr> The RFC 822 Return-Path: statement
-sender <addr>     The RFC 822 Sender: statement

For backward consistency, the -f and -i options have precedence over these
RFC 822 defined options.  If both -f and -i options are omitted then the
RFC 821 MAIL FROM statement will be defaulted to use the installation-defined
default sender address.
*/
  
  class email{
      //blat -server [localhost:1099] -u [username@yourdomain.com] -pw [password] -to [emailAddressTo] -subject [subject] -body [messageBody] -f [username@yourdomain.com]
      
      static $path = "c:/xampp/htdocs/blat.exe";
      static $server = "localhost:1099"; //stunneled to smtp.zoho.com:465
      static $user = "webserver@domain.com"; //recommendation is zoho.com, 10 free accounts @yourdomain
      static $pass = "yourPasswordHere";
      
      static function send($to,$subject,$body){
          $arguments = array("server"=>self::$server,"u"=>self::$user,"pw"=>self::$pass,"to"=>$to,"subject"=>$subject,"body"=>$body,"f"=>self::$user);
          $command = self::$path;
          
          foreach($arguments as $key => $value)
              $command .= " -".$key." ".escapeshellarg($value);
          
          exec($command, $output, $return_var);
          return array("return_var"=>$return_var,"command"=>$command,"command_line_output"=>$output);
      }
      
  }
  
?>