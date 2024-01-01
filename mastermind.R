library(ggplot2)
library(patchwork)



colors = c('red' , 'yellow' , 'orange',
           'pink' , 'black' , 'white' ,
           'green' , 'blue')


cpu_cols = sample(colors , replace = T , size = 5)


try = 1 # number of try 

previous_try = data.frame()
game = data.frame()









play = function(){
  
  # let player choose colors
    col1 = readline()
    
    if(!(col1 %in% colors)){
      print(paste(col1 , "is not a color."))
    }
    
    col2 = readline()
    
    if(!(col2 %in% colors)){
      print(paste(col1 , "is not a color."))
      
    }
    col3 = readline()
    
    if(!(col3 %in% colors)){
      print(paste(col1 , "is not a color."))
      
    }
    col4 = readline()
    if(!(col4 %in% colors)){
      print(paste(col1 , "is not a color."))
      
    }
    col5 = readline()
    if(!(col5 %in% colors)){
      print(paste(col1 , "is not a color."))
      
    }
    player_cols = c(col1,col2,col3,col4,col5)
    
  # create dataframe of colors from cpu and player 
    
    current_try = data.frame(try = rep(try , length(player_cols)) , 
               cpu = cpu_cols , 
               player = player_cols,
               pointer = rep('grey' , 5),
               pos = seq(1:length(player_cols)))
    
    
    
    
    
    
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
    
    try = try + 1 # update value of try
    
    game = rbind(previous_try , current_try)
    
    previous_try = current_try
    
}





(player = game |> ggplot(aes(y = try , x = pos)) + 
  geom_point(size = 10 , fill = game$player,
             col = 'black' , pch = 21) +
    theme(panel.background = element_rect(fill = 'white'),
          panel.border = element_rect(color = 'black',
                                      fill = NA),
          text = element_text(size = 20)) + 
  scale_y_continuous(breaks = c(1:try)) + 
  xlab('') +
  ylab('')) 




(pointer = game |> ggplot(aes(y = try , x = pos)) + 
  geom_point(size = 10 , fill = game$pointer,
             col = 'black' , pch = 21) +
  theme(panel.background = element_rect(fill = 'white'),
        panel.border = element_rect(color = 'black',
                                    fill = NA),
        text = element_text(size = 20)) + 
  scale_y_continuous(breaks = c(1:try)) + 
  xlab('') +
  ylab('# Try') )

pointer + player & plot_layout(guides = 'collect')



               