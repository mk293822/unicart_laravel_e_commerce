document.addEventListener('DOMContentLoaded', function () {

    const formOpen = document.getElementById('formOpen');
    const orderForm = document.getElementById('orderForm');
    const cartTable = document.getElementById('cartTable');

    // console.log(route);

    if (formOpen) {
        formOpen.addEventListener('click', () => {
            if (orderForm) {
                orderForm.classList.remove('hidden');
                cartTable.classList = 'hidden';
            }
        });
    }

    if (orderForm) {
        orderForm.addEventListener('submit', function (e) {
            orderForm.classList = 'hidden';
            cartTable.classList.remove('hidden');
            location.reload();
        });
    }

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const productId = this.querySelector('input[name="product_id"]').value;
            console.log(productId);
            const formData = new FormData(this);
            formData.append('product_id', productId);

            fetch("http://localhost:8000/dashboard/add_cart", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                });
        });
    });

    document.querySelectorAll('.quantityChange').forEach(item => {
        item.addEventListener('change', (e) => {

            formOpen.classList = 'hidden';
            formOpen.innerHTML = '';
            setTimeout(() => {

                const data = {
                    quantity: e.target.value,
                    id: e.target.dataset.itemId,

                }
                console.log(data)
                fetch("http://localhost:8000/cart", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data),
                })
                    .then(response => response.json())
                    .then(data => {
                        location.reload();
                        formOpen.classList.remove('hidden');
                        formOpen.innerHTML = 'Order';
                        // console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Something went wrong. Please try again.');
                    });
            }, 500);
        })
    });

});
