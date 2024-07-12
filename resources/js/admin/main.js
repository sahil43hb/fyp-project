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

    /////////////////////////----------- Admin Authentication ----------------////////////////////////////////
    // $("#adminLogin").submit(function (event) {
    //     event.preventDefault(); // Prevent the form from submitting normally
    //     var formData = $(this).serialize();
    //     console.log(formData);
    //     return;
    //     $.ajax({
    //         type: "POST", // Use POST method
    //         url: "/admin-panel/login", // Specify the URL of your controller
    //         data: formData, // Pass the form data
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
    //         },
    //         success: function (response) {
    //             console.log("Success:", response);
    //             if (response.status) {
    //                 window.location = response.redirect;
    //             } else {
    //                 $("#errors-list").append(
    //                     "<div class='alert alert-danger'>" +
    //                         response.error +
    //                         "</div>"
    //                 );
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             // Handle errors
    //             console.error("Error:", error);
    //         },
    //     });
    // });

    //////////////////---------------- Category Section -----------------------/////////////////////////////

    var table = $("#example").DataTable({
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
            { data: "active_status", name: "active_status" },
            { data: "action", name: "action" },
        ],
    });

    var categoryData;
    $("#example").on("click", ".edit-btn", function (event) {
        categoryData = $(this).data("category");
        $("#categoryEdit").modal("show");
        $("#categoryTitle").val(categoryData.title);
        $("#categoryActiveStatus").val(categoryData.active_status);

        // alert("Edit button clicked for category ID: " + categoryId);
    });

    $("#example").on("click", ".delete-btn", function (event) {
        categoryData = $(this).data("category");
        $("#delateModal").modal("show");
    });

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
                console.error("Error:", error);
            },
        });
    });

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
            { data: "active_status", name: "active_status" },
            { data: "action", name: "action" },
        ],
    });

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

    $("#sub_category_table").on("click", ".delete-btn", function (event) {
        subCategoryData = $(this).data("sub_category");
        $("#delateModal").modal("show");
    });

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
                console.error("Error:", error);
            },
        });
    });

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
            { data: "active_status", name: "active_status" },
            { data: "action", name: "action" },
        ],
    });

    var brandData;
    $("#brand_table").on("click", ".edit-btn", function (event) {
        brandData = $(this).data("brand");
        $("#categoryEdit").modal("show");
        $("#brandTitle").val(brandData.title);
        $("#brandStatus").val(brandData.active_status);

        // alert("Edit button clicked for category ID: " + categoryId);
    });

    $("#brand_table").on("click", ".delete-btn", function (event) {
        brandData = $(this).data("brand");
        $("#delateModal").modal("show");
    });

    $("#addBrand").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize();
        console.log(formData);
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
                // Handle errors
                console.error("Error:", error);
            },
        });
    });

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
                console.error("Error:", error);
            },
        });
    });

    //////////////---------- Usrs Table ------------------/////////////////////////////

    $("#user_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
    });

    $("#order_table").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
    });

    ////////////////////////////////  Products Sectionss //////////////////////////////////////////

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
        serverSide: true,
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "sku", name: "sku" },
            { data: "category_name", name: "category_name" },
            { data: "sub_category_name", name: "sub_category_name" },
            { data: "brand_name", name: "brand_name" },
            { data: "price", name: "price" },
            { data: "size_no", name: "size_no" },
            { data: "action", name: "action" },
        ],
    });

    // ;
    $("#category_id").on("change", function () {
        var category_id = $(this).val();
        console.warn(category_id);
        $.ajax({
            type: "GET",
            url: `/admin-panel/sub_categories/${category_id}`,
            success: function (data) {
                $("#sub_categories_id").empty();
                $.each(data, function (key, value) {
                    $("#sub_categories_id").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.title +
                            "</option>"
                    );
                });
            },
        });
    });

    $("#sale").on("change", function () {
        var sale_value = $(this).val();
        if (sale_value === "1") {
            $("#discount_container").css("display", "block");
        } else {
            $("#discount_container").css("display", "none");
        }
    });

    var productData;
    $("#product_table").on("click", ".edit-btn", function (event) {
        productData = $(this).data("product");
        console.log(productData);
        $("#fullscreenModalEditModal").modal("show");
        $("#sku").val(productData.sku);
        $("#price").val(productData.price);
        $("#size_no").val(productData.size_no);
        $("#edit_category_id").val(productData.category_id);
        $("#brands_id").val(productData.brands_id);
        $("#seasonability").val(productData.seasonability);
        $("#new_collection").val(productData.new_collection);
        $("#description").val(productData.description);
        $("#sale").val(productData.sale);
        if (productData.sale === "1") {
            $("#discount_container").css("display", "block");
            $("#discount").val(productData.discount);
        } else {
            $("#discount_container").css("display", "none");
        }
        $("#edit_sub_categories_id").append(
            '<option value="' +
                productData.sub_category.id +
                '">' +
                productData.sub_category.title +
                "</option>"
        );
        $("#edit_sub_categories_id").val(productData.sub_categories_id);
        const imageUrl = base_url + "uploads/" + productData.product_image;
        $("#image_prev").attr("src", imageUrl);
    });

    $("#product_table").on("click", ".delete-btn", function (event) {
        productData = $(this).data("product");
        $("#delateModal").modal("show");
    });

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
                console.error("Error:", error);
            },
        });
    });

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

    // $(".nav-link").addClass("collapsed");

    // $(".nav-link").on("load", function () {
    //     // Remove active class from all nav items
    //     // $(".nav-link").addClass("collapsed");
    //     // Add active class to the clicked nav item
    //     $(this).addClass("collapsed");
    // });

    // // Event listener to hide all collapse elements when a main nav item is clicked
    // $(".nav-link").click(function () {
    //     // Remove active class from all nav items
    //     // $(".nav-link").addClass("collapsed");
    //     // Add active class to the clicked nav item
    //     $(this).removeClass("collapsed");
    // });
});
