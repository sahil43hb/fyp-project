$(document).ready(function () {

    $(document).ready(function () {
        $('#loading-overlay').hide();
    });

    /////// Orders histiry ==============================///////
    $("#users_order").DataTable({
        language: {
            lengthMenu: "_MENU_", // Customize the text as per your preference
            info: "Showing _START_ to _END_ of _TOTAL_ entries", // Optionally, customize other text
        },
    });

    $("#search_input").keyup(function () {
        var query = $(this).val(); // Get the search query from the input field
        // Perform AJAX request only if the query is not empty
        if (query.trim() !== "") {
            // Perform AJAX request
            $.ajax({
                url: "/search/" + query,
                type: "GET",
                success: function (response) {
                    let productHtml = "";

                    response.products.forEach((product) => {
                        let priceContent;
                        if (product.sale === "0") {
                            priceContent = `
                         <div class="price">
                          <h6>Size: ${product.size_no}</h6>
                          <h6>Price: ${product.price}</h6>
                          </div>
                    `;
                        } else {
                            priceContent = `
                <div class="price">
                  <h6>Size: ${product.size_no}</h6>
                  </div>
            <div class="price">
                <h6>Rs. ${parseInt(product.price) * (parseInt(product.discount) / 100)
                                }</h6>
                <h6 class="l-through"> Rs. ${product.price}</h6>
            </div>
        `;
                        }
                        productHtml += `
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="single-product card flex-fill product-image shadow-sm shadow-hover">
                        <img class="img-fluid custom-height" src="uploads/${product.product_image}" alt="${product.product_image}" />
                        <div class="product-details pl-2">
                            <h6>${product.name}</h6>

                          
                           ${priceContent}
                            <div class="prd-bottom">
                                <a href="javascript:void(0)" class="social-info add-to-cart-search"

                                    data-product-id="${product.id}">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">add to bag</p>
                                </a>
                                <a href="product-detail/${product.id}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">view more</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    });

                    $("#products-container").html(productHtml);
                    $(".add-to-cart-search").on("click", function () {
                        let authUser = response.user_status;
                        if (!authUser) {
                            $("#loginModal").modal("show");
                        } else {
                            if (authUser.email_verified_at) {
                                var productId = $(this).data("product-id");
                                const quantity = $("#sst").val();
                                const productQuantity = quantity ? quantity : 1;
                                $.ajax({
                                    url: "/add-to-cart",
                                    method: "POST",
                                    data: {
                                        productId: productId,
                                        quantity: productQuantity,
                                    },
                                    headers: {
                                        "X-CSRF-TOKEN": $(
                                            'meta[name="csrf-token"]'
                                        ).attr("content"),
                                    },
                                    success: function (response) {
                                        if (response.status) {
                                            toastr.success(response.message);
                                            $("#cartData").text(
                                                response.totalCarts
                                            );
                                            setTimeout(() => {
                                                window.location = "/cart";
                                            }, 1000);
                                        } else {
                                            toastr.error(response.message);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(
                                            "Error adding product to cart:",
                                            error
                                        );
                                    },
                                });
                            } else {
                                toastr.error(
                                    "Please verify your email before adding to cart."
                                );
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error(error);
                },
            });
        }
    });
    $(".nav-item").click(function () {
        // Remove active class from all menu items
        $(".nav-item").removeClass("active");

        $(this).addClass("active");
    });


    // Add User
    $("#registerationForm").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var formData = $(this).serialize();

        var user_name = $("#username").val().trim();
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();

        // Check if email or password is empty
        if (
            user_name === "" ||
            name === "" ||
            email === "" ||
            password === ""
        ) {
            toastr.success("Fields cannot be empty.");
            return; // Exit the function if fields are empty
        }else{            
        $('#loading-overlay').show();
        $('body').css('cursor', 'not-allowed');
        }

        // Process form data here (e.g., send it to a server using AJAX)
        $.ajax({
            type: "POST", // Use POST method
            url: "/submit", // Specify the URL of your controller
            data: formData, // Pass the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
            },
            success: function (response) {

                // If the response indicates success, redirect
                if (response.status) {
                    window.location = response.redirect;
                } else {
                    $('#loading-overlay').hide();
                    $('body').css('cursor', 'auto');
                }
            },
            error: function (xhr, status, error) {
                $(".text-danger").remove(); 
                 // Hide the loader
                $('#loading-overlay').hide();
                $('body').css('cursor', 'auto');
                if (xhr.status === 422) {                    
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $("#" + key) // Target the specific input field
                        .after("<span class='text-danger'>" + val[0] + "</span>");
                }); 
                }else{
                    console.log("Error:", error);
                    toastr.error("An error occurred, please try again.");
                }  
            },
        });
    });

    $("#loginForm").submit(function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var email = $("#email").val().trim();
    var password = $("#password").val().trim();
    // Check if email or password is empty
    if (email === "" || password === "") {
        toastr.error("Email or Password fields cannot be empty.");
        return; // Exit the function if email or password is empty
    }
    var formData = $(this).serialize();

    $.ajax({
        type: "POST", // Use POST method
        url: "/login", // Specify the URL of your controller
        data: formData, // Pass the form data
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token in headers
        },
        success: function (response) {
            if (response.status) {
                toastr.success(response.success);
                setTimeout(() => {
                    window.location = response.redirect;
                }, 1000);
            } else {
                toastr.error(response.error);
            }
        },
        error: function (xhr, status, error) {
            // Handle errors
            console.log("Error:", error);
        },
    });
    });

    $(".forgot_password").on("click", function () {
        $("#ForgotPasswordModal").modal("show");
    });

    $(".add-to-cart-btn").on("click", function () {
        var authUser = $(this).attr("auth");
        console.warn("authUser", authUser);
        if (!authUser) {
            $("#loginModal").modal("show");
        } else {
            authUser = JSON.parse(authUser);
            if (authUser.email_verified_at) {
                var productId = $(this).data("product-id");
                const quantity = $("#sst").val();
                const productQuantity = quantity ? quantity : 1;

                $.ajax({
                    url: "/add-to-cart",
                    method: "POST",
                    data: {
                        productId: productId,
                        quantity: productQuantity,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.message);
                            $("#cartData").text(response.totalCarts);
                            setTimeout(() => {
                                window.location = "/cart";
                            }, 1000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error adding product to cart:", error);
                    },
                });
            } else {
                toastr.error("Please verify your email before adding to cart.");
            }
        }
    });

    $(".increase").click(function () {
        var row = $(this).closest("tr");
        var productQuantity = parseInt(
            row.find(".product_qty").data("product-quantity")
        );
        var cartId = parseInt(row.find(".product").data("cart-id"));
        var productPrice = $(this)
            .closest("tr")
            .find(".price")
            .data("cart-price");
        var $input = row.find(".input-text"); // Find the input field in the same row as the clicked button
        var value = parseInt($input.val());
        if (!isNaN(value) && value < productQuantity) {
            let updatedValue = $input.val(value + 1);

            $.ajax({
                url: `/add-to-cart/${cartId}`,
                method: "PUT",
                data: {
                    quantity: updatedValue.val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ), // Include CSRF token in headers
                },
                success: function (response) {
                    // Handle success response, such as updating the cart count
                    updateTotalPrice(row, updatedValue.val(), productPrice);
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error("Error adding product to cart:", error);
                },
            });
        }else{
            toastr.error('Maximum quantity reached');
        }
    });

    var selectedCarts = [];

    function toggleSelected(cartId) {
        var index = selectedCarts.indexOf(cartId);
        if (index === -1) {
            // Product ID not found, so add it to the array
            selectedCarts.push(cartId);
        } else {
            // Product ID found, so remove it from the array
            selectedCarts.splice(index, 1);
        }
    }
    //Click on checkbox
    $(".form-check  input[type='checkbox']").click(function () {
        var row = $(this).closest("tr");
        // Get the product ID from the data attribute of the closest <tr> element
        var cartId = parseInt(row.data("cart-id"));
        toggleSelected(cartId);
    });

    $(".reduced").click(function () {
        var row = $(this).closest("tr");
        var $input = row.find(".input-text");
        var cartId = parseInt(row.find(".product").data("cart-id"));
        var value = parseInt($input.val());
        var productPrice = $(this)
            .closest("tr")
            .find(".price")
            .data("cart-price");
        if (!isNaN(value) && value > 1) {
            let updatedValue = $input.val(value - 1);
            $.ajax({
                url: `/add-to-cart/${cartId}`,
                method: "PUT",
                data: {
                    quantity: updatedValue.val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ), // Include CSRF token in headers
                },
                success: function (response) {
                    // Handle success response, such as updating the cart count
                    updateTotalPrice(row, updatedValue.val(), productPrice);
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error("Error adding product to cart:", error);
                },
            });
        }
    });

    $("#checkoutForm").submit(function (event) {
        event.preventDefault();

        if (selectedCarts.length > 0) {
        // Show the loader and hide the button text
        $('#loading-overlay').show();
        $('body').css('cursor', 'not-allowed');

            $.ajax({
                url: `/checkout`,
                method: "POST",
                data: {
                    carts: selectedCarts,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ), // Include CSRF token in headers
                },
                success: function (response) {
                    // Handle success response, such as updating the cart count
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        $('#loading-overlay').hide();
                        alert("Failed to initiate checkout process");
                    }
                },
                error: function (xhr, status, error) {
                    $('#loading-overlay').hide();
                    // Handle error response
                    console.error("Error adding product to cart:", error);
                },
            });
        } else {
            toastr.error("Plese select atleast one item!");
        }
    });
});

function updateTotalPrice(row, quantity, productPrice) {
    var totalPrice = quantity * productPrice;
    row.find(".price").text(`Rs.${totalPrice.toFixed(0)}`);
    updateTotalSum();
}

function updateTotalSum() {
    var totalSum = 0;
    $(".price").each(function () {
        totalSum += parseFloat($(this).text().replace("Rs.", "")); // Remove currency symbol before parsing
    });
    $("#totalSum").text(`Rs.${totalSum.toFixed(0)}`);
}

// glass effect on hover on image
$(document).ready(function () {
    $('.image-container').on('mousemove', function (e) {
        const $container = $(this);
        const $image = $container.find('.hover-glass-image');
        const $zoomglass = $container.find('.zoom-glass');

        const containerOffset = $container.offset();
        const mouseX = e.pageX - containerOffset.left; // Mouse X relative to the container
        const mouseY = e.pageY - containerOffset.top;  // Mouse Y relative to the container

        const imageWidth = $image.width();
        const imageHeight = $image.height();

        // Calculate zoom background position as percentages
        const bgPosX = (mouseX / imageWidth) * 100; // X position in percentage
        const bgPosY = (mouseY / imageHeight) * 100; // Y position in percentage

        // Display and position the zoom box
        $zoomglass.css({
            display: 'block',
            left: mouseX - $zoomglass.width() / 2, // Center the zoom box around the cursor
            top: mouseY - $zoomglass.height() / 2, // Center the zoom box around the cursor
            backgroundImage: `url(${$image.attr('src')})`,
            backgroundSize: `${imageWidth * 3}px ${imageHeight * 3}px`, // Zoom level (2x here)
            backgroundPosition: `${bgPosX}% ${bgPosY}%`, // Focus on the hovered pixel
        });
    });

    $('.image-container').on('mouseleave', function () {
        const $zoomglass = $(this).find('.zoom-glass');
        $zoomglass.hide(); // Hide the zoom box when the mouse leaves the image
    });
});
