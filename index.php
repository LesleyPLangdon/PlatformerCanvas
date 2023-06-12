<html>
  <head>
    <title>Platformer with Canvas</title>
    <!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->
    <!-- <script defer src="script.js"></script> -->
  </head>
  <body>
    <canvas id="gameCanvas" width="1100" height="800"></canvas> 

  <!--
  This script places a badge on your repl's full-browser view back to your repl's cover
  page. Try various colors for the theme: dark, light, red, orange, yellow, lime, green,
  teal, blue, blurple, magenta, pink!
  -->
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  </body>
  <script>
       const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const player = {
            x: 50,
            y: 300,
            speed: 2,
            size: 50,
            vspeed: 0,
            jumping: true
        };

        const camera = {
            x: 0,
            y: 0,
            width: canvas.width,
            height: canvas.height
        };

        const platforms = [
          { x: 0, y: 400, width: 200, height: 50 },
            { x: 200, y: 500, width: 300, height: 50 },
            { x: 500, y: 400, width: 200, height: 50 },
          { x: 700, y: 500, width: 300, height: 50 },
            { x: 1000, y: 400, width: 200, height: 50 },
          { x: 1200, y: 500, width: 300, height: 50 },
            { x: 1500, y: 400, width: 200, height: 50 },
          { x: 1700, y: 500, width: 300, height: 50 },
            { x: 2000, y: 400, width: 200, height: 50 },
          { x: 2200, y: 500, width: 300, height: 50 },
            { x: 2500, y: 400, width: 200, height: 50 },
            // More platforms...
        ];

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw platforms
            ctx.fillStyle = '#555';
            for (let p of platforms) {
                ctx.fillRect(p.x - camera.x, p.y - camera.y, p.width, p.height);
            }

            // Draw player
            ctx.fillStyle = '#f00';
            ctx.fillRect(player.x - camera.x, player.y - camera.y, player.size, player.size);

            // Simple camera follow
            if (player.x > canvas.width / 2) {
    camera.x = player.x - (canvas.width / 2);
}
//        camera.x = player.x - (canvas.width / 2);
            camera.y = player.y - (camera.height / 2);
        }
let keys = {};

window.addEventListener('keydown', function(e) {
  console.log("keydow");
    keys[e.key] = true;
});

window.addEventListener('keyup', function(e) {
  console.log("keyup");
    keys[e.key] = false;
});
        function update() {
          if (keys['ArrowLeft']) {
            console.log("left pressed");
        player.x -= player.speed;
    }

    if (keys['ArrowRight']) {
      console.log("right pressed");
        player.x += player.speed;
    }
          // Check if player goes off screen
    // if (player.x < 0) {
    //     player.x = 0;
    // } else if (player.x > canvas.width - player.size) {
    //     player.x = canvas.width - player.size;
    // }
       // Jump
    if (keys[' '] && !player.jumping) {
        player.vspeed = -20;
    }


    // Increase vertical speed (gravity)
    player.vspeed += 1;
 // Predict next position
    let nextY = player.y + player.vspeed;

    // Check for collision with platforms
    let onPlatform = false;
    // Check for collision with platforms
    for (let p of platforms) {
        // Check if player is above the platform and falling down onto it
        if (player.x + player.size > p.x &&
    player.x < p.x + p.width &&
    player.y + player.size <= p.y &&
    nextY + player.size >= p.y) {

            // Collision detected, place player on top of platform and reset vertical speed
            nextY = p.y - player.size;
            player.vspeed = 0;
            onPlatform = true;
           
            break;  // No need to check other platforms
        }
    }
          // No collision detected, player is in the air
    player.jumping = !onPlatform;
 // Update vertical position
    player.y = nextY;

            draw();
            requestAnimationFrame(update);
        }

        update();
  </script>
</html>