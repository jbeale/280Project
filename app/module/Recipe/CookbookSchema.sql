create table cookbook(
    
    userID int NOT NULL,
    recipeID int NOT NULL,
    
    PRIMARY KEY(userID, recipeID)
)


SELECT *
FROM recipe
INNER JOIN cookbook
ON recipe.recID=cookbook.recipeID
WHERE cookbook.userID = 0;