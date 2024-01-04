library(ggplot2)
library(patchwork)



colors = c('red' , 'yellow' , 'orange',
           'pink' , 'black' , 'white' ,
           'green' , 'blue')



reset = function(){
  
  cpu_cols = sample(colors , replace = T , size = 5)



  previous_try = data.frame(matrix(nrow = 0 , ncol = 5))
  colnames(previous_try) = c('try' , 'cpu' , 'player' , 'pointer' , 'pos')


  game = data.frame(matrix(nrow = 0 , ncol = 5))
  colnames(game) = c('try' , 'cpu' , 'player' , 'pointer' , 'pos')

  try = 1 # number of try 
  
  assign("cpu_cols" , cpu_cols , envir = .GlobalEnv)
  assign("previous_try" , previous_try , envir = .GlobalEnv)
  assign("game" , game , envir = .GlobalEnv)
  assign("try" , try , envir = .GlobalEnv)

}






play = function(){
  
  # let player choose colors
    col1 = readline()
    
    col2 = readline()
    
    col3 = readline()
  
    col4 = readline()
    
    col5 = readline()
    
    player_cols = c(col1,col2,col3,col4,col5)
    
    if(!(all(player_cols %in% colors))){
      return(print("Insert a valid color"))
    }
  # create dataframe of colors from cpu and player 
    
    current_try = data.frame(try_num = rep(try , length(player_cols)) , 
               cpu = cpu_cols , 
               player = player_cols,
               pointer = rep('grey' , 5),
               pos = seq(1:length(player_cols)))
    
    
    try = try + 1 # update value of try
    assign("try" , try , env = .GlobalEnv)
    
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
    
    #previous_try = current_try # convert current to previous
    #assign("previous_try" , previous_try , env = .GlobalEnv)
    
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
                        "You won")
    
    
    
    if(all(current_try$pointer == c(rep('black' , 5)))){
      return(list_for_end)
    }
    
    
    return(pointer + player & plot_layout(guides = 'collect'))
}









               