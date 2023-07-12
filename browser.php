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
$browserHistory->visit("google.com");
$browserHistory->visit("facebook.com");
$browserHistory->visit("youtube.com");
$result = [
    $browserHistory->visit(null),
    $browserHistory->back(1),
    $browserHistory->back(1),
    $browserHistory->forward(1),
    $browserHistory->visit("linkedin.com"),
    $browserHistory->forward(2),
    $browserHistory->back(2),
    $browserHistory->back(7)
];

foreach ($result as $value) {
    echo $value . "\n";
}
?>