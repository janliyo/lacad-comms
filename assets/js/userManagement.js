document.getElementById("searchButton").addEventListener("click", function () {
	var searchValue = document.getElementById("search").value.toLowerCase();
	var userRows = document.querySelectorAll("#userTable tbody tr");
	var filteredRows = Array.from(userRows).filter(function (row) {
		var userName = row.querySelector(".userName").textContent.toLowerCase();
		var userEmail = row.querySelector(".userEmail").textContent.toLowerCase();
		return userName.includes(searchValue) || userEmail.includes(searchValue);
	});

	userRows.forEach(function (row) {
		row.style.display = "none";
	});

	filteredRows.forEach(function (row) {
		row.style.display = "";
	});

	resetPagination(filteredRows);
	updateUserCount(filteredRows.length, userRows.length);
});

function resetPagination(filteredRows) {
	var pagination = document
		.getElementById("pagination")
		.querySelector(".pagination");
	pagination.innerHTML = "";

	var itemsPerPage = 3;
	var pageCount = Math.ceil(filteredRows.length / itemsPerPage);

	for (let i = 1; i <= pageCount; i++) {
		let li = document.createElement("li");
		li.className = "page-item";
		let a = document.createElement("a");
		a.className = "page-link";
		a.href = "#";
		a.textContent = i;
		a.addEventListener("click", function (event) {
			event.preventDefault();
			var start = (i - 1) * itemsPerPage;
			var end = start + itemsPerPage;

			filteredRows.forEach(function (row) {
				row.style.display = "none";
			});

			filteredRows.slice(start, end).forEach(function (row) {
				row.style.display = "";
			});
		});
		li.appendChild(a);
		pagination.appendChild(li);
	}

	if (pageCount > 0) {
		pagination.querySelector("a").click();
	}
}

function updateUserCount(showingCount, totalCount) {
	document.getElementById(
		"userCount"
	).textContent = `Showing ${showingCount} out of ${totalCount} existing users`;
}

function showUserDetails(id, username, email, status, image) {
	document.querySelector(".user-details").dataset.id = id;
	document.getElementById("userName").textContent = username;
	document.getElementById("userStatus").textContent = `Status: ${status}`;
	document.getElementById("userEmail").textContent = `Email: ${email}`;
	document.getElementById("userUsername").textContent = `Username: ${username}`;

	var avatar = document.getElementById("userAvatar");
	if (image && image !== "NULL" && image !== "") {
		avatar.src = base_url + "uploads/employees/" + image;
	} else {
		avatar.src = base_url + "assets/images/default-profile.png";
	}

	avatar.classList.remove("d-none");
	document.getElementById("userName").classList.remove("d-none");
	document.getElementById("userStatus").classList.remove("d-none");
	document.getElementById("userEmail").classList.remove("d-none");
	document.getElementById("userUsername").classList.remove("d-none");
	document.getElementById("updateButton").classList.remove("d-none");

	var updateButton = document.getElementById("updateButton");
	updateButton.href = base_url + "UserManagementController/update/" + id;
	updateButton.classList.remove("d-none");
}

document.addEventListener("DOMContentLoaded", function () {
	var userRows = document.querySelectorAll("#userTable tbody tr");
	resetPagination(Array.from(userRows));

	document.querySelectorAll(".userRow").forEach(function (row) {
		row.addEventListener("click", function () {
			var id = this.dataset.id;
			var username = this.dataset.username;
			var email = this.dataset.email;
			var status = this.dataset.status;
			var image = this.dataset.image;

			showUserDetails(id, username, email, status, image);
		});
	});

	document
		.getElementById("updateButton")
		.addEventListener("click", function () {
			var userId = document.querySelector(".user-details").dataset.id;

			if (userId) {
				window.location.href =
					base_url + "UserManagementController/update/" + userId;
			} else {
				alert("No user selected!");
			}
		});
});
