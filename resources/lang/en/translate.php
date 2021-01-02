<?php

return [

    #=================================== start profile ===================================
    'user_name' => 'Username',
    'user_name_placeholder' => 'Enter Username',
    'email' => 'Email',
    'email_placeholder' => 'Enter Email',
    'change_password' => 'Change Password',
    #=================================== end profile ===================================

    #=================================== start store ===================================
    'stores' => 'Stores',
    'store_data' => 'Store Data',
    'create_store' => 'Create Store',
    'edit_store' => 'Edit Store',
    'store_name' => 'Store Name',
    'store_name_placeholder' => 'Enter Store Name',
    'store_phone' => 'Store Phone',
    'store_phone_placeholder' => 'Enter Store Phone',
    'store_address' => 'Store Address',
    'store_address_placeholder' => 'Enter Store Address',
    //ajax ptoducts of store error
    'new_stored_quantity_must_be_less_than_or_equal_old_stored_quantity' => 'The new stored quantity must be less than or equal old stored quantity',
    'new_minimum_stored_quantity_must_be_less_than_or_equal_new_stored_quantity' => 'The new minimum stored quantity must be less than or equal new stored quantity',
    #=================================== end store ===================================

    #=================================== start worker ===================================
    'workers' => 'Workers',
    'worker_data' => 'Worker Data',
    'create_worker' => 'Create Worker',
    'edit_worker' => 'Edit Worker',
    'worker_name' => 'Worker Name',
    'worker_name_placeholder' => 'Enter Worker Name',
    'worker_age' => 'Worker Age',
    'worker_age_placeholder' => 'Enter Worker Age',
    'national_id' => 'National Id',
    'national_id_placeholder' => 'Enter National Id',
    'worker_address' => 'Worker Address',
    'worker_address_placeholder' => 'Enter Worker Address',
    'worker_phone' => 'Worker Phone',
    'worker_phone_placeholder' => 'Enter Worker Phone',
    'worker_salary' => 'Worker Salary',
    'worker_salary_placeholder' => 'Enter Worker Salary',
    'worker_per' => 'Per',
    'worker_permission' => 'Worker Permission',
    'manager' => 'Manager',
    'worker' => 'Worker',
    'worker_photo' => 'Worker Photo',
    #=================================== end worker ===================================

    #=================================== start company ===================================
    'companies' => 'Companies',
    'company_data' => 'Company Data',
    'create_company' => 'Create Company',
    'edit_company' => 'Edit Company',
    'company_name' => 'Company Name',
    'company_name_placeholder' => 'Enter Company Name',
    'company_phone' => 'Company Phone',
    'company_phone_placeholder' => 'Enter Company Phone',
    'company_address' => 'Company Address',
    'company_address_placeholder' => 'Enter Company Address',
    'company_manager' => 'Company Manager',
    'company_manager_placeholder' => 'Enter Name Of Company Manager',
    #=================================== end company ===================================

    #=================================== start product ===================================
    'products' => 'Products',
    'product_data' => 'Product Data',
    'create_product' => 'Create Product',
    'edit_product' => 'Edit Product',
    'product_name' => 'Product Name',
    'store_id' => 'Store Name',
    'Product_name_placeholder' => 'Enter Product Name',
    'product_price' => 'Product Price',
    'product_price_placeholder' => 'Enter Product Price',
    'total_quantity' => 'Total Quantity',
    'total_quantity_placeholder' => 'Enter Total Quantity',
    'used_quantity' => 'Used Quantity',
    'used_quantity_placeholder' => 'Enter Used Quantity',
    'stored_quantity' => 'Stored Quantity',
    'minimum_used' => 'Minimum Used',
    'minimum_stored' => 'Minimum Stored',
    'minimum_used_placeholder' => 'Enter Minimun Used Quantity',
    'stored_quantity_placeholder' => 'Enter Stored Quantity',
    'minimum_stored_placeholder' => 'Enter Minimun Stored Quantity',
    'product_photo' => 'Product Photo',
    //ajax stored quantity error
    'total_quantity_error' => 'invalid total quantity',
    'used_quantity_error' => 'invalid used quantity',
    'stored_quantity_error' => 'invalid stored quantity',
    'minimum_stored_field_is_required' => 'The minimum stored field is required',
    'minimum_stored_must_be_a_number' => 'The minimum stored must be a number',
    'has_reached_its_minimum' => ' has reached its minimum',
    'add_product_first' => 'add one product at the least first',
    #=================================== end product ===================================

    #=================================== start sale ===================================
    'sales' => 'Sales',
    'sale_data' => 'Sale Data',
    'create_sale' => 'Create Sale',
    'add_product' => 'Add New Product',
    'edit_sale' => 'Edit Sale',
    'product_name' => 'Product Name',
    'quantity' => 'Product Quantity',
    'quantity_placeholder' => 'Enter Qauntity Address',
    'once_price' => 'Once Price',
    'total_price' => 'Total Price',
    //ajax sale error
    'quantity_error' => 'invalid quantity',
    'total_price_error' => 'invalid total price',
    'maximum_quantity_of' => 'The maximum quantity of ',
    'is' => ' is ',
    #=================================== end sale ===================================

    #=================================== start debt ===================================
    'debts' => 'Debts',
    'debt_data' => 'Debt Data',
    'create_debt' => 'Create Debt',
    'edit_debt' => 'Edit Debt',
    'debt_title' => 'Debt Title',
    'debt_title_placeholder' => 'Enter Debt Title',
    'debt_details' => 'Debt Details',
    'debt_details_placeholder' => 'Enter Details Body',
    'pay_date' => 'Pay Date',
    'remember_date' => 'Remember Date',
    #=================================== end debt ===================================

    #=================================== start validation ===================================
    'email_field_is_required' => 'The email field is required',
    'email_field_should_be_correct_email' => 'The email field should be correct email',

    'name_field_is_required' => 'The name field is required',
    'name_field_should_be_unique' => 'The name field should be unique',

    'phone_field_is_required' => 'The phone field is required',
    'phone_format_is_invalid' => 'The phone format is invalid',
    'phone_field_should_be_unique' => 'The phone field should be unique',

    'address_field_is_required' => 'The address field is required',

    'national_id_field_is_required' => 'The national id field is required',
    'national_id_field_must_be_a_number' => 'The national id field must be a number',
    'national_id_field_should_be_unique' => 'The national id field should be unique',

    'salary_field_is_required' => 'The salary field is required',
    'salary_field_must_be_a_number' => 'The salary field must be a number',

    'per_field_is_required' => 'The per field is required',

    'store_name_field_is_required' => 'The store name field is required',

    'worker_permission_field_is_required' => 'The worker permission field is required',

    'company_manager_field_is_required' => 'The company manager field is required',

    'price_field_is_required' => 'The price field is required',
    'price_must_be_a_number' => 'The price must be a number',

    'total_quantity_field_is_required' => 'The total quantity field is required',
    'total_quantity_must_be_a_number'  => 'The total quantity must be a number',

    'used_quantity_field_is_required' => 'The used quantity field is required',
    'used_quantity_must_be_a_number'  => 'The used quantity must be a number',

    'stored_quantity_field_is_required' => 'The stored quantity field is required',
    'stored_quantity_must_be_a_number'  => 'The stored quantity must be a number',

    'minimum_used_field_is_required' => 'The minimum used quantity field is required',
    'minimum_used_must_be_a_number' => 'The minimum used quantity must be a number',
    'minimum_used_must_not_be_greater_than_used_quantity' => 'The minimum used quantity must not be greater than used quantity',

    'company_name_field_is_required' => 'The company name field is required',

    'minimum_stored_must_not_be_greater_than_stored_quantity' => 'The minimum stored quantity must not be greater than stored quantity',

    'photo_must_be_an_image' => 'The photo must be an image',
    'photo_may_not_be_greater_than_2.5_mb' => 'The photo may not be greater than 2.5 mb',

    'quantity_field_is_required' => 'The quantity field is required',
    'quantity_field_must_be_a_number' => 'The quantity field must be a array',

    'once_price_field_is_required' => 'The once price field is required',
    'once_price_field_must_be_a_array' => 'The once price field must be a array',

    'total_price_field_is_required' => 'The total price field is required',
    'total_price_field_must_be_a_number' => 'The total price field must be a number',

    'age_field_is_required' => 'The age field is required',
    'age_field_must_be_a_number' => 'The age price field must be a number',

    'title_field_is_required' => 'The title field is required',
    'title_field_should_be_unique' => 'The title field should be unique',

    'details_field_is_required' => 'The details field is required',
    'details_may_not_be_greater_than_255_characters' => 'The details may not be greater than 255 characters',

    'pay_date_field_is_required' => 'The pay date field is required',
    'pay_date_must_be_a_correct_date' => 'The pay date must be a correct date',

    'remember_date_field_is_required' => 'The remember date field is required',
    'remember_date_must_be_a_correct_date' => 'The remember date must be a correct date',
    #=================================== end validation ===================================

    #=================================== start general ===================================
    'dashboard' => 'Dasboard',
    'admin_panel' => 'Admin Panel',
    'main' => 'Main',
    'profile_data' => 'Profile Data',
    'edit_profile' => 'Edit Profile',
    'logout' => 'Logout',
    'languages' => 'Languages',
    'welcome' => 'Welcome',
    'notifications' => 'Notifications',
    'read_notifications' => 'Read all notifications',
    'messages' => 'Messages',
    'read_messages' => 'Read all messages',
    'measures' => 'Measures',
    'save' => 'Save',
    'edit' => 'Edit',
    'move' => 'Move',
    'delete' => 'Delete',
    'cancel' => 'Cancel',
    'show_all' => 'Show All',
    'show_workers' => 'Show Workers',
    'show_products' => 'Show Products',
    'move_confirmation' => 'Move Confirmation',
    'edit_confirmation' => 'Edit Confirmation',
    'saved_success' => 'data saved successfully',
    'saved_error' => 'data was not saved successfully',
    'updated_success' => 'data updated successfully',
    'updated_error' => 'data was not updated successfully',
    'deleted_success' => 'data deleted successfully',
    'deleted_error' => 'data was not deleted successfully',
    #=================================== end general ===================================

];
