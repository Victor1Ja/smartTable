# Smart Menu App

A digital menu app built with Laravel that allows restaurants to offer contactless dining experiences for their customers. Customers can scan QR codes to access the restaurant's digital menu, place orders, and make payments conveniently. The app also provides order management and analytics for restaurant owners.

## Installation

### Clone this repository to your local machine:

```bash
git clone https://github.com/Victor1Ja/smartTable
```

### Navigate to the project folder:

```bash
    cd smartTable
```

### Install Composer dependencies:

```bash
    composer install
```

### Create a .env file by copying the .env.example:

```bash
cp .env.example .env
```

### Generate an application key:

```bash
    php artisan key:generate
```

### Environment Configuration

Configure the database settings in your .env file, including the database name, username, and password.

### Migrate the database:

```bash
php artisan migrate
```

### Run the development server:

```bash
php artisan serve
```

Access the app in your web browser at http://localhost:8000.

## License

MIT
