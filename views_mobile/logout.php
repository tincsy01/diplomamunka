<?php
session_start();
session_unset();
header("Location: ../views_website/index.php");