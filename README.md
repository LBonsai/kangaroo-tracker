# Kangaroo Tracker

Kangaroo Tracker is a web application that allows you to track kangaroos. Follow the instructions below to set up and run the application.

## Prerequisites

Make sure you have the following software installed before proceeding:

- XAMPP ([Download Xampp](https://www.apachefriends.org/))
- Git ([Download Git - Optional](https://git-scm.com/))
- Composer ([Download Composer](https://getcomposer.org/download/))
- Node.js ([Download Node.js](https://nodejs.org/en))

## Installation

1. Install the prerequisites mentioned above.
2. Navigate to the `C:\xampp\htdocs` directory in your drive where you installed the XAMPP application.
3. Clone the Kangaroo Tracker app by running the following command in PowerShell or in your Git app:

```bash
git clone -b develop https://github.com/LBonsai/kangaroo-tracker.git
```

4. Start your XAMPP app. Open a web browser and go to http://localhost/phpmyadmin. Create a new database named "kangaroo_tracker".
5. Go to the `kangaroo-tracker` directory and open it in your preferred IDE.
6. Once you have the project open in your IDE, run the following commands one at a time to install the required packages and dependencies:

```bash
composer install
npm install
```

7. After a successful installation, create a `.env` file in the root directory of Kangaroo Tracker. Use the provided `.env` settings below.
8. Run the following commands to set up the database:

```bash
php artisan migrate
```


9. Go to your PHPMyAdmin again and navigate to the "kangaroo" table. Import the `kangaroo.sql` file.
10. Finally, run the following commands to start the application:

```bash
npm run dev
php artisan serve
```

11. Access the Kangaroo Tracker app by going to http://localhost:8000 in your web browser.
12. That's it! You can now explore and enjoy the app.

Note: For any issues or further information, please refer to the project repository at [https://github.com/LBonsai/kangaroo-tracker](https://github.com/LBonsai/kangaroo-tracker).


## Environment Setting
```bash
APP_NAME="Kangaroo Tracker"
APP_ENV=local
APP_KEY=base64:uZ89+iWLY6Kjk10+IafWCYhAhQt4wLngiewPXCD9vXw=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kangaroo_tracker
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

APP_TIMEZONE=Asia/Manila
```
