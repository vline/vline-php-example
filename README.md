# vLine PHP Example

Sample PHP app that demonstrates vLine API integration.

## Getting Started

1. Sign up for a [vLine developer account](https://vline.com/developer/) and create your vLine service.
1. Make note of your `API Secret` on the `Service Settings` tab in the [vLine Developer Console](https://vline.com/developer/app/).
1. Make sure you have MySQL installed and running on your computer.
    * If your installation did not set a password for the root user (e.g.,
    [Homebrew](http://mxcl.github.io/homebrew/) on OSX),
    you can set it with: `mysqladmin -u root password mynewpassword`
    * If using the default PHP installation on OSX, you may need to copy `/etc/php.ini.default` to `/etc/php.ini` and
     set `mysqli.default_socket` to `/tmp/mysql.sock`:

            sudo cp /etc/php.ini.default /etc/php.ini
            sudo vim /etc/php.ini

            # Find "mysqli.default_socket" and set it to:
            mysqli.default_socket = /tmp/mysql.sock

1. Clone this repository.
1. Add your `Service ID` and `API Secret` to the `vline-php-example/classes/Vline.php` file.
1. Run the `server.sh` script to automatically start Apache. (If you prefer, you can use any other webserver to serve
up the `vline-php-example` directory.)
1. In your browser go to [http://localhost:8080](http://localhost:8080) and
 follow the application installation steps.
1. In your browser, go to [http://localhost:8080/admin/](http://localhost:8080/admin/)
1. Add at least one additional user.
1. Open [http://localhost:8080](http://localhost:8080) in one regular browser window and one incognito window.
1. Log in as different users in the two windows.
1. Click on a username to call that user.
