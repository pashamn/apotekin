document.addEventListener('DOMContentLoaded', function () {
    // Event Listener untuk tombol tambah
    document.querySelectorAll('.add-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.cartId;

            fetch(`/cart/increase/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      location.reload();
                  }
              });
        });
    });

    // Event Listener untuk tombol kurangi
    document.querySelectorAll('.subtract-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.cartId;

            fetch(`/cart/decrease/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      location.reload();
                  }
              });
        });
    });

    // Event Listener untuk tombol hapus
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.dataset.cartId;

            fetch(`/cart/remove/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      location.reload();
                  }
              });
        });
    });
});
