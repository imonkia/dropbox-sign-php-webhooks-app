# Dropbox Sign PHP Webhook Server Example
This basic app listens for and validates Dropbox Sign webhooks.

This app uses the PHP Symfony framework and the official [Drobpox Sign PHP SDK](https://github.com/hellosign/dropbox-sign-php).

## How to use

### Install dependencies:
```
composer install
```

### Set up environment variable:
Add your Dropbox Sign `API_KEY` in the `.env` file found in the root of the project.

### Start the server:
```
symfony server:start
```