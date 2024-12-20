# FarmerManagementSystem

<h1>Prospect Farmers App Setup</h1>
<h4>Getting the System</h4>
<pre>
git remote add origin https://github.com/br3-mah/ProspectFarmersApp.git

git fetch

git pull origin master
</pre>

<h4>Running the System</h4>
<pre>
composer install

php artisan migrate:fresh --seed
</pre>

</body>
</html>
