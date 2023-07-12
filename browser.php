<?php
class BrowserHistory {
    private $history;
    private $current;

    function __construct($homepage) {
        $this->history = [$homepage];
        $this->current = 0;
    }

    function visit($url) {
        $this->history = array_slice($this->history, 0, $this->current + 1);
        $this->history[] = $url;
        $this->current++;
    }

    function back($steps) {
        $this->current = max($this->current - $steps, 0);
        return $this->history[$this->current];
    }

    function forward($steps) {
        $maxIndex = count($this->history) - 1;
        $this->current = min($this->current + $steps, $maxIndex);
        return $this->history[$this->current];
    }
}

$browserHistory = new BrowserHistory("leetcode.com");

echo "Browser History!\n";
while (true) {
    echo "Enter an action (visit, back, forward, exit): ";
    $action = trim(fgets(STDIN));

    if ($action === "exit") {
        break;
    }

    switch ($action) {
        case "visit":
            echo "Enter the URL to visit: ";
            $url = trim(fgets(STDIN));
            $browserHistory->visit($url);
            break;
        case "back":
            echo "Enter the number of steps to go back: ";
            $steps = trim(fgets(STDIN));
            $result = $browserHistory->back((int)$steps);
            echo "You are now at: $result\n";
            break;
        case "forward":
            echo "Enter the number of steps to go forward: ";
            $steps = trim(fgets(STDIN));
            $result = $browserHistory->forward((int)$steps);
            echo "You are now at: $result\n";
            break;
        default:
            echo "Invalid action. Please try again.\n";
            break;
    }
}

echo "Exiting the Browser History.\n";
?>