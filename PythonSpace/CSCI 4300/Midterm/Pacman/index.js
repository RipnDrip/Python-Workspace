import { LEVEL, OBJECT_TYPE } from './setup';
import { randomMovement } from './ghostmoves';
// Classes
import GameBoard from './GameBoard';
import Pacman from './Pacman';
import Ghost from './Ghost';
// Sounds
import soundDot from './sounds/munch.wav';
import soundPill from './sounds/pill.wav';
import soundGameStart from './sounds/game_start.wav';
import soundGameOver from './sounds/death.wav';
import soundGhost from './sounds/eat_ghost.wav';
// Dom Elements
const gameGrid = document.querySelector('#game');
const scoreTable = document.querySelector('#score');
const startButton = document.querySelector('#start-button');
// Game constants
const POWER_PILL_TIME = 10000; // ms

//Change global speed from 80 to 100 ms therefore makeing the game loop run a bit faster and smoother
const GLOBAL_SPEED = 100; // ms
const gameBoard = GameBoard.createGameBoard(gameGrid, LEVEL);
// Initial setup
let score = 0;
let timer = null;
let gameWin = false;
let powerPillActive = false;
let powerPillTimer = null;

// --- AUDIO --- //
function playAudio(audio) {
// Plays audio for a given sound effect
  const soundEffect = new Audio(audio);
  soundEffect.play();
}

// --- GAME CONTROLLER --- //
//Function to run when the game is over
function gameOver(pacman, grid) {
   //Plays game over sound
  playAudio(soundGameOver);
  //Delete listeners for the gameboard
  document.removeEventListener('keydown', (e) =>
    pacman.handleKeyInput(e, gameBoard.objectExist.bind(gameBoard))
  );

  //Shows if game has been won
  gameBoard.showGameStatus(gameWin);

   //sets imer to 0
  clearInterval(timer);
  // Show startbutton
  startButton.classList.remove('hide');
}

//Checks for a collision between pacman and ghost
function checkCollision(pacman, ghosts) {
  // Checks ghost's position to see if it equals pacman's position
  const collidedGhost = ghosts.find((ghost) => pacman.pos === ghost.pos);

//If collision is true, and pacman does not have power up pill active, then game over
  if (collidedGhost) {
  //If collision is true and pacman has pill power up, then eat ghost and increase score 100
    if (pacman.powerPill) {
    //plays scared ghost song
      playAudio(soundGhost);

      //Removes collided ghost
      gameBoard.removeObject(collidedGhost.pos, [
        OBJECT_TYPE.GHOST,
        OBJECT_TYPE.SCARED,
        collidedGhost.name
      ]);
      collidedGhost.pos = collidedGhost.startPos;
      score += 100;
    }
    else {
    //If pacman does not have power up and collides with ghost, score set to zero
      //Score becomes 0
      score = 0;
      //Deletes pacman object hence he dies
      //gameBoard.removeObject(pacman.pos, [OBJECT_TYPE.PACMAN]);
      //After collision current direction of pacman is reversed
      gameBoard.rotateDiv(pacman.pos, 180);
      //After collision current direction of ghost is reversed
      gameBoard.rotateDiv(ghost.pos, 180);
      gameOver(pacman, gameGrid);
    }
  }
}

//Keeps game running while the game has not been won
function gameLoop(pacman, ghosts) {
  // 1. Move Pacman
  gameBoard.moveCharacter(pacman);
  // 2. Check Ghost collision on the old positions
  checkCollision(pacman, ghosts);
  // 3. Move ghosts
  ghosts.forEach((ghost) => gameBoard.moveCharacter(ghost));
  // 4. Do a new ghost collision check on the new positions
  checkCollision(pacman, ghosts);
  // 5. Check if Pacman eats a dot
  if (gameBoard.objectExist(pacman.pos, OBJECT_TYPE.DOT)) {
    playAudio(soundDot);

    gameBoard.removeObject(pacman.pos, [OBJECT_TYPE.DOT]);
    // Remove a dot
    gameBoard.dotCount--;
    // Add Score
    score += 10;
  }
  // 6. Check if Pacman eats a power pill
  if (gameBoard.objectExist(pacman.pos, OBJECT_TYPE.PILL)) {
    playAudio(soundPill);

    //Pill disappears
    gameBoard.removeObject(pacman.pos, [OBJECT_TYPE.PILL]);

    pacman.powerPill = true;
    score += 50;

    //clears powerpill timer
    clearTimeout(powerPillTimer);
    powerPillTimer = setTimeout(
      () => (pacman.powerPill = false),
      POWER_PILL_TIME
    );
  }
  // 7. Change ghost scare mode depending on powerpill
  if (pacman.powerPill !== powerPillActive) {
    powerPillActive = pacman.powerPill;
    ghosts.forEach((ghost) => (ghost.isScared = pacman.powerPill));
  }
  // 8. Check if all dots have been eaten
  if (gameBoard.dotCount === 0) {
    gameWin = true;
    gameOver(pacman, gameGrid);
  }
  // 9. Show new score
  scoreTable.innerHTML = score;
}


//Main function to start game and keep game running
function startGame() {
  //Plays game start audio
  playAudio(soundGameStart);

  gameWin = false;
  powerPillActive = false;
  score = 0;

  startButton.classList.add('hide');

  //Creates grid for map
  gameBoard.createGrid(LEVEL);

  //Create Pacman
  const pacman = new Pacman(2, 287);
  gameBoard.addObject(287, [OBJECT_TYPE.PACMAN]);
  document.addEventListener('keydown', (e) =>
    pacman.handleKeyInput(e, gameBoard.objectExist.bind(gameBoard))
  );

  //Creates Ghosts
  const ghosts = [
    new Ghost(5, 188, randomMovement, OBJECT_TYPE.BLINKY),
    new Ghost(4, 209, randomMovement, OBJECT_TYPE.PINKY),
    new Ghost(3, 230, randomMovement, OBJECT_TYPE.INKY),
    new Ghost(2, 251, randomMovement, OBJECT_TYPE.CLYDE)
  ];

  // Gameloop
  timer = setInterval(() => gameLoop(pacman, ghosts), GLOBAL_SPEED);
}

// Initialize game
startButton.addEventListener('click', startGame);