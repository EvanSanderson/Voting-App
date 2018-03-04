### Code Challenge for Symplicity

How I Would Do Users: 

1. Add some form input that allows users to enter in their credentials, be authenticated based on a table in the DB i.e John enters his email and its checked against a db row of users. 
2. User cannot access app without entering credentials - if they exist in DB, then get their information from the proper table, if not create a new user with that name/email
3. Change the table structure to have the following columns: User Name, User Email, Apple, Banana, Pineapple, Orange, which would let us track votes based on user
4. Add additional param to API call with user email to get the right row, which returns that users particular row. 
5. All POST/PUT requests include the additional param of the user email, so that the right row is updated
