# Base website security demo
- designed for Intraworlds security workshop

## Development
### Installation
1. [Install Docker](https://docs.docker.com/install/)
1. [Install Docker Compose](https://docs.docker.com/compose/install/)
1. Clone this repository `git clone https://github.com/intraworlds/HackThisWeb.git`
or download [ZIP file](https://github.com/intraworlds/HackThisWeb/archive/master.zip)

### Run
 1. before run check if your ports `localhost:80` and `localhost:8080` are "free", not running app using these ports

 1. run `docker-compose up` and you access the website
    - **app**: https://localhost/
    - username: `willis.ritchie@example.com`
    - password: `richie`
    - **adminer**: http://localhost:8080/?server=mysql&username=admin&db=demo
    - password: `1234`


## Let's go hacking...  :-) 
 - ... need any inspiration?
 
 ### attacks
 
 - [Full list of attacks](https://www.owasp.org/index.php/Category:Attack)
 
 ### XSS (Cross-site Scripting)
  - [OWASP XSS](https://www.owasp.org/index.php/Cross-site_Scripting_(XSS))
  - [OWASP testing for XSS](https://www.owasp.org/index.php/Testing_for_Cross_site_scripting)
  - [PHP triky: Cross Site Scripting](https://php.vrana.cz/cross-site-scripting.php) (czech only)
 
 ### HTTP Headers
  - [X-XSS-Protection](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection)
  - [Content-Security-Policy](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP)
 
 ### SQL injection
  - [OWASP SQL injection](https://www.owasp.org/index.php/SQL_Injection)
  - [Soom: SQL Injection (Full Paper)](https://www.soom.cz/clanky/1180--SQL-Injection-Full-Paper#sekce5) (czech only)
  - [PHP triky: Obrana proti SQL Injection](https://php.vrana.cz/obrana-proti-sql-injection.php) (czech only)
 
 ### CSFR (Cross-Site Request Forgery)
  - [OWASP CSFR](https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF))
  - [Soom](https://www.soom.cz/clanky/484--Cross-Site-Request-Forgery) (czech only)
  - [PHP triky: Cross-Site Request Forgery](https://php.vrana.cz/cross-site-request-forgery.php) (czech only)
  - [Co je Cross-Site Request Forgery a jak se mu bránit](https://www.zdrojak.cz/clanky/co-je-cross-site-request-forgery-a-jak-se-branit/) (czech only)
 
 ### Path (Directory) Traversal
  - [OWASP Path Traversal](https://www.owasp.org/index.php/Path_Traversal)
 
 ### Others
  - [Self tweeting tweet](https://twitter.com/derGeruhn/status/476764918763749376)
