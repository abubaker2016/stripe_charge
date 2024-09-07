1. stripe_charge   Download git file url : https://github.com/abubaker2016/stripe_charge

2. Laravel Framework 9.52.16

3. create .env file from .env.example(copy all and paste into .env) 

4. Database configuration in           .ENV file

5. Add/Update these variable in .ENV file 
	STRIPE_KEY=
	STRIPE_SECRET=
	CASHIER_CURRENCY=
6. run php artisan migrate
7. run php artisan db:seed

8. once all these changes done then run these command
	php artisan config:clear
	php artisan cache:clear
	composer dump-autoload

9. Use Stripe Card Detail
	Card information :4242424242424242
	MM: – you can use greater than current month.
	YYYY:- you can use greater than current Year.
	CVV: – 123
10. Create new user or user existing user
	username : abu@gmail.com
	password : Welcome@12
