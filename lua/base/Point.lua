Point = {x=0,y=0}  
Point.__index = Point   
  
function Point:new(x,y)  
    local self = {}     
    setmetatable(self, Point)   
    self.x = x or 1     
    self.y = y or 1
    return self    
end  

--calculate distance  
function Point:distance(another) 
    local dx = self.x - another.x
    local dy = self.y - another.y
    return math.sqrt(dx^2 + dy^2)
end  

function Point:equal(another)
    return self.x == another.x and self.y == another.y
end

--get the points next to the given point(up down left right)
function Point:adj(i)
    if(i == 1) then
        return self:up()
    elseif(i == 2) then
        return self:down()
    elseif(i == 3) then
        return self:left()
    elseif(i == 4) then
        return self:right()
    else
    end
end

function Point:up()
    return Point:new(self.x, self.y-1)
end

function Point:down()
    return Point:new(self.x, self.y+1)
end

function Point:left()
    return Point:new(self.x-1, self.y)
end

function Point:right()
    return Point:new(self.x+1, self.y)
end