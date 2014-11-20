Connect Four
============

This is a game, dedicated to workshop of Buildstuff 2014.
Will you manage to win others by returning a number from 0 to 6 ?

## Task

Game is based on rules of Connect Four.

**The object** of Connect Four is to get four stones of your own color in a row, be it horizontal, vertical or diagonal. Every turn a player places a stone on the board.

The stone "falls down" until it reaches the bottom of the board or another stone (so it ends up immediately above an old stone or on the first row).

![Game table](http://upload.wikimedia.org/wikipedia/commons/a/ad/Connect_Four.gif)

### Task description

* Write a class, which implements an interface src/ConnectFour/Player/PlayerInterface.php
* Please name your class as your Github username
* Put it in  src/ConnectFour/Player/Bot
* You get the grid - current situation on the table
```
[
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0]
]
```
* You should return a number from 0 to 6, which are representing a columns of the grid where you putting your disk 
* Try a game by executing command in console: 

``` 
php console run:game -t 10
```
Where -t represents how many times game should be executed

### Commiting your work

* Register/Login to http://github.com
* Create a fork of this repository
* To commit your work: simply create a Pull request

### Play online

http://ec2-54-93-210-241.eu-central-1.compute.amazonaws.com

# Build status

- Tests and code sniffer [![status](https://travis-ci.org/audriusb/connect-four.svg?branch=master)](https://travis-ci.org/audriusb/connect-four)

Questions? 
Ask mentors!
