

<h1>Prospect Farmers App Setup</h1>
<h4>Getting the System</h4>
<pre>
git remote add origin https://github.com/br3-mah/FarmerManagementSystem.git

git fetch

git pull origin master
</pre>

<h4>Running the System</h4>
<pre>
composer install

php artisan migrate:fresh --seed
</pre>


<h4>Usage Documentation</h4>

<h5>Installing Modules</h5>

1. Go to the admin dashboard.

2. Navigate to the "Settings > Packages" section and Upload Zip file containing Module.

<h5>Activating/Deactivating Modules</h5>

1. Go to the "Settings > Packages" section in the admin dashboard.

2. Toggle the activation status for the desired module.

<h5>Deleting Modules</h5>

1. Navigate to the "Packages" section in the settings.

2. Click the "Delete" button for the module you wish to remove.

3. Confirm the deletion. Optionally, you can choose to clean up the database tables.

<h5>Loan Management</h5>

1. Navigate to the "Loan Management Module" section in the admin dashboard.

2. Add a new loan by filling out the required details.

3. View loans by farmer or overall statuses.

4. Approve, reject, or mark loans as repaid.


![image](https://github.com/user-attachments/assets/1de061d6-c8a4-49bf-9acb-fe8ac95b2a48)

</body>
</html>
