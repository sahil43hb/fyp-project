$(document).ready(function () {
    $.fn.dataTable.ext.errMode = "throw";
    // Iterate through each navigation item
    $(".sidebar-nav .nav-link").each(function () {
        // Get the href attribute of the navigation item

        var url = document.location.toString();
        var href = $(this).attr("href");

        // Check if the path matches the href attribute
        if (url === href) {
            // Add 'active' class to the parent li element
            $(this).removeClass("collapsed");
        } else {
            // Add 'not-active' class to the parent li element
            $(this).addClass("collapsed");
        }
    });

    var anchor = $("#components-nav").find("a");

    // Perform actions on the anchor tag
    anchor.each(function () {
        // Your code here
        // For example, add a class to the anchor tag
        var url = document.location.toString();
        var href = $(this).attr("href");
        // Check if the path matches the href attribute
        if (url === href) {
            // Add 'active' class to the parent li element
            $(this).addClass("active");
            $("#components-nav").addClass("show");
            $("#main-category").removeClass("collapsed");
        } else {
            // Add 'not-active' class to the parent li element
            $(this).remove("active");
        }
    });

   //////////////////---------------- Category Section -----------------------/////////////////////////////

    var table = $("#category").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
        ajax: {
            url: "/admin-panel/categories",
            type: "GET",
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "title", name: "title" },
            // { data: "active_status", name: "active_status" },
            {
                data: "active_status",
                name: "active_status",
                render: function(data, type, row) {
                    return data == 1 
                        ? '<span class="badge bg-color text-white">Active</span>' 
                        : '<span class="badge badge-pill bg-danger">Disable</span>';
                }
            },
            { data: "action", name: "action" },
        ],
    });
//Show Edit Category Model
    var categoryData;
    $("#category").on("click", ".edit-btn", function (event) {
        categoryData = $(this).data("category");
        $("#categoryEdit").modal("show");
        $("#categoryTitle").val(categoryData.title);
        $("#categoryActiveStatus").val(categoryData.active_status);
    });
//Show Delete Category Model
    $("#category").on("click", ".delete-btn", function (event) {
        categoryData = $(this).data("category");
        $("#delateModal").modal("show");
    });
//Add Category
    $("#addCategory").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            type: "POST", // Use POST method
            url: "/admin-panel/categories", // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                if (response.status) {
                    table.draw();
                    $("#addCategory").trigger("reset");
                    $("#basicModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                if (xhr.status === 422) {
                    // Validation error from Laravel
                    var errors = xhr.responseJSON.message;
                    toastr.error(errors); // Show the validation error message
                } else {
                    // General error handling
                    toastr.error("An unexpected error occurred. Please try again.");
                };
            },
        });
    });
//Edit Category
    $("#editCategory").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
        let categoryId = categoryData.id;
        $.ajax({
            type: "PUT", // Use POST method
            url: `/admin-panel/categories/${categoryId}`, // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    table.draw();
                    $("#editCategory").trigger("reset");
                    $("#categoryEdit").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error("Error:", error);
            },
        });
    });
    //Delete Category
    $("#deleteCategory").submit(function (event) {
        event.preventDefault();
        let categoryId = categoryData.id;
        $.ajax({
            type: "DELETE", // Use POST method
            url: `/admin-panel/categories/${categoryId}`, // Specify the URL of your controller

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    table.draw();
                    $("#deleteCategory").trigger("reset");
                    $("#delateModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                if (xhr.status === 400) {
                    toastr.error(xhr.responseJSON.message || 'Bad Request');
                }
                else{                        
                        toastr.error('An unexpected error occurred. ');
                    }
                console.error("Error:", error);
            },
        });
    });

    ///////////////////////---------------------Sub Category Section------------------------/////////////

    var sub_categories_table = $("#sub_category_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
        ajax: {
            url: "/admin-panel/sub_categories",
            type: "GET",
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "title", name: "title" },
            { data: "category_name", name: "category_name" },
            {
                data: "active_status",
                name: "active_status",
                render: function(data, type, row) {
                    return data == 1 
                        ? '<span class="badge bg-color text-white">Active</span>' 
                        : '<span class="badge badge-pill bg-danger">Disable</span>';
                }
            },
            { data: "action", name: "action" },
        ],
    });
// Open Sub Category Model
    var subCategoryData;
    $("#sub_category_table").on("click", ".edit-btn", function (event) {
        subCategoryData = $(this).data("sub_category");
        console.warn(subCategoryData);
        $("#categoryEdit").modal("show");
        $("#subCategoryTitle").val(subCategoryData.title);
        $("#subCategoryStatus").val(subCategoryData.active_status);
        $("#categoryStatus").val(subCategoryData.category_id);
        // alert("Edit button clicked for category ID: " + categoryId);
    });
// Open Delete Sub Category Model
    $("#sub_category_table").on("click", ".delete-btn", function (event) {
        subCategoryData = $(this).data("sub_category");
        $("#delateModal").modal("show");
    });
// Add Sub Category 
    $("#addSubCategory").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            type: "POST", // Use POST method
            url: "/admin-panel/sub_categories", // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);

                if (response.status) {
                    sub_categories_table.draw();
                    $("#addSubCategory").trigger("reset");
                    $("#basicModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
               console,error(error);
            },
        });
    });
// Edit Sub Category 
    $("#editSubCategory").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
        let categoryId = subCategoryData.id;
        $.ajax({
            type: "PUT", // Use POST method
            url: `/admin-panel/sub_categories/${categoryId}`, // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    sub_categories_table.draw();
                    $("#editSubCategory").trigger("reset");
                    $("#categoryEdit").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error("Error:", error);
            },
        });
    });
// Delete Sub Category 
    $("#deleteSubCategory").submit(function (event) {
        event.preventDefault();
        let categoryId = subCategoryData.id;
        $.ajax({
            type: "DELETE", // Use POST method
            url: `/admin-panel/sub_categories/${categoryId}`, // Specify the URL of your controller

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    sub_categories_table.draw();
                    $("#deleteSubCategory").trigger("reset");
                    $("#delateModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                if (xhr.status === 400) {
                    toastr.error(xhr.responseJSON.message || 'Bad Request');
                }
                else{                        
                        toastr.error('An unexpected error occurred. ');
                    }
                console.error("Error:", error);
            },
        });
    });
    ////////////////////------------ Add Brand -----------/////////////////////////////////

    var brandTable = $("#brand_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
        ajax: {
            url: "/admin-panel/brands",
            type: "GET",
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "title", name: "title" },
            {
                data: "active_status",
                name: "active_status",
                render: function(data, type, row) {
                    return data == 1 
                        ? '<span class="badge bg-color text-white">Active</span>' 
                        : '<span class="badge badge-pill bg-danger">Disable</span>';
                }
            },
            { data: "action", name: "action" },
        ],
    });
//Open Edit Model For Brand
    var brandData;
    $("#brand_table").on("click", ".edit-btn", function (event) {
        brandData = $(this).data("brand");
        $("#categoryEdit").modal("show");
        $("#brandTitle").val(brandData.title);
        $("#brandStatus").val(brandData.active_status);
    });
//Open Delete Model For Brand
    $("#brand_table").on("click", ".delete-btn", function (event) {
        brandData = $(this).data("brand");
        $("#delateModal").modal("show");
    });
//Add Brand
    $("#addBrand").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        $.ajax({
            type: "POST", // Use POST method
            url: "/admin-panel/brands", // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    brandTable.draw();
                    $("#addBrand").trigger("reset");
                    $("#basicModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    // Validation error from Laravel
                    var errors = xhr.responseJSON.message;
                    toastr.error(errors); // Show the validation error message
                } else {
                    // General error handling
                    toastr.error("An unexpected error occurred. Please try again.");
                };
            },
        });
    });
// Edit Brand
    $("#editBrand").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
        let categoryId = brandData.id;
        $.ajax({
            type: "PUT", // Use POST method
            url: `/admin-panel/brands/${categoryId}`, // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    brandTable.draw();
                    $("#editBrand").trigger("reset");
                    $("#categoryEdit").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error("Error:", error);
            },
        });
    });
// Delete Brand
    $("#deleteBrand").submit(function (event) {
        event.preventDefault();
        let categoryId = brandData.id;
        $.ajax({
            type: "DELETE", // Use POST method
            url: `/admin-panel/brands/${categoryId}`, // Specify the URL of your controller
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    brandTable.draw();
                    $("#deleteBrand").trigger("reset");
                    $("#delateModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                if (xhr.status === 400) {
                    toastr.error(xhr.responseJSON.message || 'Bad Request');}
                    else{                        
                        toastr.error('An unexpected error occurred. ');
                    }
            },
        });
    });

    //////////////---------- Users Table ------------------/////////////////////////////

    $("#user_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
    });
    
    //////////////---------- Admin Orders Table ------------------/////////////////////////////

    $("#order_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
    });
    // Handle status update from dropdown
    $(".order-item").on("click", function (e) {
        e.preventDefault(); 
        let selectedStatus = $(this).data("value");
        let orderId = $(this).closest("td").find(".dropdown-toggle").data("order-id");
        
        $.ajax({
            url: "/admin-panel/update-shipment-status", 
            method: "POST",
            data: {
                order_id: orderId,
                shipment_status: selectedStatus,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), 
            },
            success: function (response) {
                if (response.status) {
                    let dropdownButton = $(`#dropdownMenuButton${orderId}`);
                    dropdownButton.text(selectedStatus);
        
                    // Update the background color dynamically
                    dropdownButton
                    .removeClass("bg-primary bg-danger bg-success bg-secondary")
                    .addClass(
                        selectedStatus === "Pending"
                            ? "bg-primary"
                            : selectedStatus === "Return"
                            ? "bg-danger"
                            : selectedStatus === "Complete"
                            ? "bg-success"
                            : "bg-secondary"
                    );
                    toastr.success(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 404) {
                    toastr.error(xhr.responseJSON.message || 'Bad Request');}
                    else{                        
                        toastr.error('An unexpected error occurred. ');
                    }
            },
        });
    });

    ////////////////////////////////  Products Sections //////////////////////////////////////////

    var productTable = $("#product_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
        ajax: {
            url: "/admin-panel/products",
            type: "GET",
        },
        processing: true,
        serverSide: true, //This means that pagination, filtering, and sorting are all handled by the server rather than in the client-side JavaScript.
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "sku", name: "sku" },
            { data: "category_name", name: "category_name" },
            { data: "sub_category_name", name: "sub_category_name" },
            { data: "brand_name", name: "brand_name" },
            { data: "price", name: "price" },
            { data: "size_no", name: "size_no" },
            { data: "quantity", name: "quantity" },
            { data: "action", name: "action" },
        ],
    });
    
    // On category change
    $("#category_id").on("change", function () {
        var category_id = $(this).val();
        console.warn(category_id);
        $.ajax({
            type: "GET",
            url: `/admin-panel/sub_categories/${category_id}`,
            success: function (data) {
                $("#sub_categories_id").empty();
                $.each(data, function (key, value) {
                    if(value?.active_status === '1'){
                        $("#sub_categories_id").append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.title +
                                "</option>"
                        );
                    }                   
                });
            },
        });
    });

   // Handle Sale Field in Edit Product
    $("#sale").on("change", function () {
        var sale_value = $(this).val();
        if (sale_value === "1") {
            $("#discount_container").css("display", "block");
        } else {
            $("#discount_container").css("display", "none");
        }
    });
 // Open Edit Product Model 
    var productData;
    $("#product_table").on("click", ".edit-btn", function (event) {
        productData = $(this).data("product");
        console.log(productData);
        $("#fullscreenModalEditModal").modal("show");
    
        // Populate the form fields
        $("#sku").val(productData.sku);
        $("#name").val(productData.name);
        $("#price").val(productData.price);
        $("#size_no").val(productData.size_no);
        $("#edit_category_id").val(productData.category_id);
        $("#brands_id").val(productData.brands_id);
        $("#seasonability").val(productData.seasonability);
        $("#new_collection").val(productData.new_collection);
        $("#quantity").val(productData.quantity);
        $("#description").val(productData.description);
        $("#sale").val(productData.sale);
        
        if (productData.sale === "1") {
            $("#discount_container").css("display", "block");
            $("#discount").val(productData.discount);
        } else {
            $("#discount_container").css("display", "none");
        }
        
        // Load subcategories based on the selected category
        loadSubCategories(productData.category_id, productData.sub_categories_id);
    
        const imageUrl = base_url + "uploads/" + productData.product_image;
        $("#image_prev").attr("src", imageUrl);
    });

    $("#edit_category_id").on("change", function () {
        var category_id = $(this).val();
        loadSubCategories(category_id);
    });
    
    // Function to load subcategories
    function loadSubCategories(categoryId, selectedSubCategoryId = null) {
        $.ajax({
            type: "GET",
            url: `/admin-panel/sub_categories/${categoryId}`,
            success: function (data) {
                $("#edit_sub_categories_id").empty();
                $.each(data, function (key, value) {
                    $("#edit_sub_categories_id").append(
                        '<option ' + (value.active_status === "0" ? 'disabled' : '') +' value="' +
                            value.id +
                            '">' +
                            value.title +
                            "</option>"
                    );
                });
                // If a selectedSubCategoryId is provided, set it as the selected option
                if (selectedSubCategoryId) {
                    $("#edit_sub_categories_id").val(selectedSubCategoryId);
                }
            },
        });
    }

 // Open Delete Product Model 
    $("#product_table").on("click", ".delete-btn", function (event) {
        productData = $(this).data("product");
        $("#delateModal").modal("show");
    });
 // Add Product
    $("#addProduct").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = new FormData(this);
        console.warn(formData);
        $.ajax({
            type: "POST", // Use POST method
            url: "/admin-panel/products", // Specify the URL of your controller
            data: formData, // Pass the form data
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    productTable.draw();
                    $("#addProduct").trigger("reset");
                    $("#fullscreenModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.message;
                    toastr.error(errors); // Show the validation error message
                } else {
                    // General error handling
                    toastr.error("An unexpected error occurred. Please try again.");
                }
            },
        });
    });
 // Edit Product
    $("#editProduct").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = new FormData(this);
        let product_id = productData.id;
        if (formData.get("product_image").name == "") {
            // Field exists
            formData.append("previuos_image", productData.product_image);
        }
        $.ajax({
            type: "POST", // Use POST method
            url: `/admin-panel/products/${product_id}`, // Specify the URL of your controller
            data: formData, // Pass the form data
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    productTable.draw();
                    $("#editProduct").trigger("reset");
                    $("#fullscreenModalEditModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error("Error:", error);
            },
        });
    });
 // Delete Product
    $("#deleteProduct").submit(function (event) {
        event.preventDefault();
        let product_id = productData.id;
        $.ajax({
            type: "DELETE", // Use POST method
            url: `/admin-panel/products/${product_id}`, // Specify the URL of your controller
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {
                console.log("Success:", response);
                if (response.status) {
                    productTable.draw();
                    $("#deleteProduct").trigger("reset");
                    $("#delateModal").modal("hide");
                    toastr.success(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error("Error:", error);
            },
        });
    });
});
