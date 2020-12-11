<?php

return [

    #=================================== start store ===================================
    'stores' => 'المخازن',
    'store_data' => 'بيانات المخزن',
    'create_store' => 'اضافة مخزن',
    'edit_store' => 'تعديل مخزن',
    'store_name' => 'اسم المخزن',
    'store_name_placeholder' => 'ادخل اسم المخزن',
    'store_phone' => 'هاتف المخزن',
    'store_phone_placeholder' => 'ادخل هاتف المخزن',
    'store_address' => 'عنوان المخزن',
    'store_address_placeholder' => 'ادخل عنوان المخزن',
    'store_manager' => 'مدير المخزن',
    'store_manager_placeholder' => 'ادخل اسم مدير المخزن',
    #=================================== end store ===================================

    #=================================== start company ===================================
    'companies' => 'الشركات',
    'company_data' => 'بيانات الشركة',
    'create_company' => 'اضافة شركة',
    'edit_company' => 'تعديل شركة',
    'company_name' => 'اسم الشركة',
    'company_name_placeholder' => 'ادخل اسم الشركة',
    'company_phone' => 'هاتف الشركة',
    'company_phone_placeholder' => 'ادخل هاتف الشركة',
    'company_address' => 'عنوان الشركة',
    'company_address_placeholder' => 'ادخل عنوان الشركة',
    'company_manager' => 'مدير الشركة',
    'company_manager_placeholder' => 'ادخل اسم مدير الشركة',
    #=================================== end company ===================================

    #=================================== start product ===================================
    'products' => 'المنتجات',
    'product_data' => 'بيانات المنتج',
    'create_product' => 'اضافة منتج',
    'edit_product' => 'تعديل منتج',
    'product_name' => 'اسم المنتج',
    'Product_name_placeholder' => 'ادخل اسم المنتج',
    'store_id' => 'اسم المخزن',
    'product_price' => 'سعر المنتج',
    'product_price_placeholder' => 'ادخل سعر المنتج',
    'total_quantity' => 'الكمية الاجمالية',
    'total_quantity_placeholder' => 'ادخل كمية المنتج الاجمالية',
    'used_quantity' => 'الكمية المستخدمة',
    'used_quantity_placeholder' => 'ادخل الكمية المستخدمة',
    'stored_quantity' => 'الكمية المخزنة',
    'minimum_quantity' => 'الحد الادني',
    'minimum_quantity_placeholder' => 'ادخل كمية الحد الادني',
    'product_photo' => 'صورة المنتج',
    //stored quantity error
    'total_quantity_error' => 'الكمية الاجمالية غير صحيحة',
    'used_quantity_error' => 'الكمية المستخدمة غير صحيحة',
    'stored_quantity_error' => 'الكمية المخزنة غير صحيحة',
    #=================================== end product ===================================

    #=================================== start sale ===================================
    'sales' => 'المبيعات',
    'sale_data' => 'بيانات المبيعات',
    'create_sale' => 'اضافة بيعة',
    'add_product' => 'اضافة منتج جديد',
    'edit_sale' => 'تعديل بيعة',
    'product_name' => 'اسم المنتج',
    'quantity' => 'كمية المنتج',
    'quantity_placeholder' => 'ادخل كمية المنتج',
    'once_price' => 'سعر الواحدة',
    'total_price' => 'السعر الاجمالي',
    //sale error
    'quantity_error' => 'الكمية غير صحيحة',
    'total_price_error' => 'السعر الاجمالي غير صحيح',
    #=================================== end sale ===================================

    #=================================== start profile ===================================
    'user_name' => 'اسم المستخدم',
    'user_name_placeholder' => 'ادخل اسم المستخدم',

    'email' => 'البريد الالكتروني',
    'email_placeholder' => 'ادخل البريد الالكتروني',

    'change_password' => 'تغير كلمة المرور',
    #=================================== end profile ===================================

    #=================================== end validation ===================================
    'name field is required' => 'حقل الاسم مطلوب',
    'name may not be greater than 25 characters' => 'يجب الا يزيد الاسم عن 25 حرفا',
    'name field should be unique' => 'يجب ان يكون حقل الاسم فريدا',

    'phone field is required' => 'حقل الهاتف مطلوب',
    'phone format is invalid' => 'تنسيق حقل الهاتف غير صحيح',
    'phone field should be unique' => 'يجب ان يكون حقل الهاتف فريدا',

    'address field is required' => 'حقل العنوان مطلوب',

    'manager field is required' => 'حقل المدير مطلوب',

    'price field is required' => 'حقل السعر مطلوب',
    'price must be a number'  => 'حقل السعر يجب ان يكون رقما',

    'total quantity field is required' => 'حقل الكمية الاجمالية مطلوب',
    'total quantity must be a number'  => 'حقل الكمية الاجمالية يجب ان يكون رقما',

    'used quantity field is required' => 'حقل الكمية المستخدمة مطلوب',
    'used quantity must be a number'  => 'حقل الكمية المستخدمة يجب ان يكون رقما',

    'stored quantity field is required' => 'حقل الكمية المخزنة مطلوب',
    'stored quantity must be a number'  => 'حقل الكمية المخزنة يجب ان يكون رقما',

    'store name field is required' => 'حقل اسم المخزن مطلوب',
    'company name field is required' => 'حقل اسم الشركة مطلوب',

    'minimum quantity field is required' => 'حقل كمية الحد الادني مطلوب',
    'minimum quantity must be a number' => 'حقل الحد الادني يجب ان يكون رقما',

    'photo must be an image' => 'يجب ان تكون الصورة صورة',
    'photo may not be greater than 2.5 mb' => 'يجب الا يزيد حجم الصورة عن 2.5 ميغا بايت',

    'quantity field is required' => 'حقل الكمية مطلوب',
    'quantity field must be a array' => 'حقل الكمية يجب ان يكون مصفوفة',

    'once price field is required' => 'حقل سعر الواحدة مطلوب',
    'once price field must be a array' => 'حقل الكمية يجب ان يكون مصفوفة',

    'total price field is required' => 'حقل السعر الاجمالي مطلوب',
    'total price field must be a number' => 'حقل السعر الاجمالي يجب ان يكون رقما',

    'email field is required' => 'حقل البريد الالكتروني مطلوب',
    'email field should be correct email' => 'حقل البريد الالكتروني يجب ان يكون بريدا صحيحا',
    #=================================== end validation ===================================

    #=================================== start general ===================================
    'dashboard' => 'لوحة التحكم',
    'edit_profile' => 'تعديل الملف الشخصي',
    'profile_data' => 'بيانات الملف الشخصي',
    'logout' => 'تسجيل خروج',
    'admin_panel' => 'لوحة الادارة',
    'languages' => 'اللغات',
    'welcome' => 'مرحبا',
    'notifications' => 'الاشعارات',
    'read_notifications' => 'قراءة جميع الاشعارات',
    'messages' => 'الرسائل',
    'read_messages' => 'قراءة جميع الرسائل',
    'save' => 'حفظ',
    'print' => 'طباعة',
    'edit' => 'تعديل',
    'delete' => 'حذف',
    'cancel' => 'الغاء',
    'measures' => 'الاجراءات',
    'saved_success' => 'تم حفظ بيانات بنجاح',
    'saved_error' => 'لم يتم حفظ البيانات بنجاح',
    'updated_success' => 'تم تعديل البيانات بنجاح',
    'updated_error' => 'لم يتم تعديل البيانات بنجاح',
    'deleted_success' => 'تم حذف البيانات بنجاح',
    'deleted_error' => 'لم يتم حذف البيانات بنجاح',
    'show_all' => 'عرض الكل',
    'main' =>  'الرئيسية',
    #=================================== end general ===================================

];
