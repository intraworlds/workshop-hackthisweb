<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" href="/?path=list">List of transaction</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/?path=create">Add new transaction</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/?path=logout<?= ENABLE_SECURE_LOGOUT ? '&secTok=' . $_SESSION['csrf'] : '' ?>">Logout</a>
  </li>
</ul>
