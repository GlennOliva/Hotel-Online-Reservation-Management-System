  <!-- Sidebar -->
  <aside id="sidebar">
    <div class="sidebar-title">
      <div class="sidebar-brand">
      <div class="icon-container">
    <div class="circle-icon">
        <img src="images/logo.jpg" alt="Fabulous Finds">
    </div>

</div>


      </div>
      <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
    </div>

    <style>
      .icon-container {
    text-align: center; /* Center items horizontally */
}

.circle-icon {
    width: 190px; /* Adjust the size as needed */
    height: 170px; /* Adjust the size as needed */
    border-radius: 50%; /* Makes the container circular */
    overflow: hidden; /* Ensures the image stays within the circle */
    display: inline-block; /* Make sure the container is inline so text-align works */
}

.circle-icon img {
    width: 100%; /* Ensures the image fills the circular container */
    height: auto; /* Maintains aspect ratio */
}

.icon-details {
    /* Add any additional styling for the text/details */
}

.icon-details p {
    margin: 0; /* Remove default margin for the paragraph */
}


    </style>

    <ul class="sidebar-list">
      <li class="sidebar-list-item">
        <a href="index.php" >
          <span class="material-icons-outlined">dashboard</span> Dashboard
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="manage_room.php" >
          <span class="material-icons-outlined">hotel</span> Manage Room
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="manage_admin.php">
          <span class="material-icons-outlined">person</span> Manage Admin
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="manage_user.php">
          <span class="material-icons-outlined">group</span> Manage User
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="manage_history.php">
          <span class="material-icons-outlined">list_alt</span> Transaction History
        </a>
      </li>
      <li class="sidebar-list-item">
        <a href="manage_salesreport.php" >
          <span class="material-icons-outlined">poll</span> Sales Report
        </a>
      </li>

      <li class="sidebar-list-item">
        <a href="manage_chat.php" >
          <span class="material-icons-outlined">message</span> Manage Chat
        </a>
      </li>

      <li class="sidebar-list-item">
        <a href="update_adminprofile.php" >
          <span class="material-icons-outlined">manage_accounts</span> Update Profile
        </a>
      </li>


      <li class="sidebar-list-item">
        <a href="admin_logout.php">
          <span class="material-icons-outlined">logout</span> Logout
        </a>
      </li>
    </ul>
  </aside>
  <!-- End Sidebar -->