---
layout: default
title:  "Mastermind"
date:   2024-01-04 23:30:00 +0100
---

So this is the 1st post :) I wanted to share a piece of code that I did just for fun after discovering the board game [Mastermind](https://en.wikipedia.org/wiki/Mastermind_(board_game)). In this case, the computer samples 5 times from a set of 8 colors with replacement, and the user will try to guess the colors that were chosen and their position. This is done in R, and visualized through 2 plots (using ```ggplot2```) that are shown together using ```patchwork``` to simulate the actual board. 

This is a Mastermind board, with 4 colors. If the player has guessed the position, it's indicated with a red "pointer", and if the player has guessed the color but not the position, it's indicated with a white pointer. 

<img src="https://github.com/suarezalvarez/suarezalvarez.github.io/assets/90506642/809ac6cc-5acd-4110-b186-78c00f7144da" width="400" />

In my case, I chose to play with 5 colors, unlimited opportunities, and black for the guessed position and white for the guessed color. This is an example of how the "board" looks using my code:

<img src="https://github.com/suarezalvarez/suarezalvarez.github.io/assets/90506642/f60cdb11-f2e4-4e5a-b2e5-efcb0b73ad5b" width="400" />

## Code

Here you can see the code. As a summary, I just created 2 functions:
- The function ```reset()```, that sets the number of tries to 1, samples 5 times from the colors, and sets everything to "default" to start a new game.
- The function ```play()```, that begins a player turn. It lets the player write the 5 colors, and will create a dataframe with the current play, and set the colors (black/white/grey) for the pointers depending on whether the positions and colors that the user chose are correct. Then, it will append this dataframe to the previous turns in the ```game``` dataframe. This allows for plotting all the turns together, having a global view of the play (it's important for the development of the game). 

```r
# import packages

library(ggplot2)
library(patchwork)

# colors to sample from

colors = c('red' , 'yellow' , 'orange',
           'pink' , 'black' , 'white' ,
           'green' , 'blue') 

# create reset function: set number of tries to 0, sample colors, and
# save variables to global environment

reset = function(){
  
  cpu_cols = sample(colors , replace = T , size = 5)

  game = data.frame(matrix(nrow = 0 , ncol = 5)) # create empty "game" dataframe
  colnames(game) = c('try' , 'cpu' , 'player' , 'pointer' , 'pos')

  try = 1 # number of try 
  
  assign("cpu_cols" , cpu_cols , envir = .GlobalEnv)
  assign("game" , game , envir = .GlobalEnv)
  assign("try" , try , envir = .GlobalEnv)

}




# create play function: let user choose 5 colors, update the "game" dataframe
# and plot the results

play = function(){
  
   # let player choose colors
    print("Choose color in position 1")
    col1 = readline()
    
    print("Choose color in position 2")
    col2 = readline()
    
    print("Choose color in position 3")
    col3 = readline()
    
    print("Choose color in position 4")
    col4 = readline()
    
    print("Choose color in position 5")
    col5 = readline()
    
    player_cols = c(col1,col2,col3,col4,col5)
    
    if(!(all(player_cols %in% colors))){
      return(print("Insert a valid color")) 
    }  # get error message if color is not valid
    
    
  # create dataframe of colors from cpu and player 
    
    current_try = data.frame(try_num = rep(try , length(player_cols)) , 
               cpu = cpu_cols , 
               player = player_cols,
               pointer = rep('grey' , 5),
               pos = seq(1:length(player_cols)))
    
    
    try = try + 1 # update value of try
    assign("try" , try , env = .GlobalEnv) # save try to global env
    
  # checking if position is right and col is right
    
    black = 0
    white = 0
    for(i in seq(1:nrow(current_try))){
      
      if(current_try$cpu[i] == current_try$player[i]){
        black = black + 1
      }
    
      else if(current_try$player[i] %in% current_try$cpu){
        white = white + 1
      }
    }
    
    if(black != 0){
    current_try$pointer[1:black] = 'black' # correct positions
    }
    
    if(white != 0){
    current_try$pointer[(black + 1):(black+white)] = 'white' # correct colors
    }
    
    
    game = rbind(game , current_try) # update game dataframe
    assign("game" , game , env = .GlobalEnv)
    

    # plot board

    player = game |> ggplot(aes(y = try_num , x = pos)) + 
        geom_point(size = 10 , fill = game$player,
                   col = 'black' , pch = 21) +
        theme(panel.background = element_rect(fill = 'white'),
              panel.border = element_rect(color = 'black',
                                          fill = NA),
              text = element_text(size = 20)) + 
        scale_y_continuous(breaks = c(1:try) , n.breaks = try) + 
        xlab('') +
        ylab('')
    
    
    
    
    pointer = game |> ggplot(aes(y = try_num , x = pos)) + 
        geom_point(size = 10 , fill = game$pointer,
                   col = 'black' , pch = 21) +
        theme(panel.background = element_rect(fill = 'white'),
              panel.border = element_rect(color = 'black',
                                          fill = NA),
              text = element_text(size = 20)) + 
        scale_y_continuous(breaks = c(1:try), n.breaks = try) + 
        xlab('') +
        ylab('# Try') 
    
    list_for_end = list(pointer + player & plot_layout(guides = 'collect'),
                        "You won") # winning output
    
    
    
    if(all(current_try$pointer == c(rep('black' , 5)))){
      return(list_for_end) # winning message
    }
    
    
    return(pointer + player & plot_layout(guides = 'collect')) # return plots
}









               
```
