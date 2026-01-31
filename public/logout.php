<?php
session_start();
session_destroy();
header("Location: ../Blog Page/index.html");
