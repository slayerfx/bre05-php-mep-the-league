<?php
$choice = $_GET['choice'];
$heroName = $_GET['heroName'];

if ($choice === 'choice-1') {
    header('Location: page-2a.php?heroName=' . $heroName);
} else {
    header('Location: page-2b.php?heroName=' . $heroName);
}
