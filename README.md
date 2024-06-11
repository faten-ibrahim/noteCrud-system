# noteCrud-system

####################
system documentation
####################

1- installation guide:

- download project
- run composer install
- run php atrisan key:generate
- create mysql database
- create .env file
- cofigure database variables in .env file
  and other database configration.
- run php artisan migrate
- run php artisan db:seed
- npm install && npm run dev
- run php artisan:serve ,run application into the browser

- to test email verification and reset password features you should create a test account on mailtrap
  and set accound credentails at .env file

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=8a0bd323**\***
MAIL_PASSWORD=\***\*\*\*\*\*\***
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

2- for testing api ,here a documentation link

https://documenter.getpostman.com/view/36199719/2sA3XMi3RR

===================
System Features: ||
===================

# User Interface :

- Registration
- Login
- Logout
- CRUD Notes Application: (at /home url click on notes link)
  User is able to create new notes.
  User is able to view a list of their notes vai yajra datatables
  User is able to update existing notes vai a form implemented by spatie/laravel-html
  User is able to delete notes.
  user can only access and manage his own notes.
- email verification for user registration.
- "Forgot Password" feature to allow users to reset their passwords via email

                <===================================>


# API:

- Api documentation ==> https://documenter.getpostman.com/view/36199719/2sA3XMi3RR

* User Registration
* User Login
* User Logout
* User Profile Management

* CRUD Notes Application:
  User is able to create new notes.
  User is able to view a list of their notes vai yajra datatables
  User is able to update existing notes vai a form implemented by spatie/laravel-html
  User is able to delete notes.
  user can only access and manage his own notes.

finally I wish My work gets your approval .
thanks
