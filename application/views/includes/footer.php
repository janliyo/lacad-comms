<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="<?= base_url("assets/js/populateSelect.js"); ?>"></script>
<script src="<?= base_url("assets/js/userManagement.js"); ?>"></script>

<script>
// Toggle sidebar on burger icon click
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('show');
});

const sidebar = document.querySelector('.sidebar');
const navbarToggler = document.querySelector('.navbar-toggler');

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sidebar.classList.remove('show');
        navbarToggler.classList.add('scrolled');
    } else {
        sidebar.classList.remove('scrolled');
        navbarToggler.classList.remove('scrolled');
    }
});

navbarToggler.addEventListener('click', () => {
    if (sidebar.classList.contains('show')) {
        sidebar.classList.remove('show');
    } else {
        sidebar.classList.add('show');
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 768 &&!navbarToggler.classList.contains('scrolled')) {
        sidebar.classList.remove('scrolled');
    }
});

// New event listener for resizing the window
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && sidebar.classList.contains('scrolled')) {
        sidebar.classList.remove('scrolled');
        navbarToggler.classList.remove('scrolled');
    }
});

$(document).ready(function() {
    $('.navbar-toggler').on('click', function() {
        $('.sidebar').toggleClass('show');
    });
});

document.getElementById("signout-link").addEventListener("click", function(event) {
    event.preventDefault();

    if (confirm("Are you sure you want to sign out?")) {
        window.location.href = "<?= base_url("LoginController/signout")?>";
    } else {
        alert("Sign out cancelled.");
    }
});
</script>

</body>
</html>