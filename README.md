# cs148_final_project
This is the code for my final project in Database Design for Web class (CS148). In this project I worked with one teammate, who was responsible for all front-end work, while I was responsible for all backend work. I built all CRUD functionality for the activities, login and password verfication (salted and hashed), and designed the database structure. 

# Key Takeaways
-Database design is very important for the ease of work later on. The due dates for certain sections of the project ended up committing me to a database design that a few weeks later I realized was not optimal. This led to some creative SQL work to get the queries to work as intended for the user. Specifically the $activityQuery defined at the top of index.php.

-Working in a team requires coordination. As we were working on different things, it was easy to keep out of one another's way. However towards the end of the project we sometimes had to converge and work on the same file to meet a deadline. This gave me experience in resolving merge conflicts. I learned the best way is to simply avoid them in the first place, as they can be time consuming to resolve (at least in Github's native UI. I've learned there are better tools out there which can speed this process up greatly).


# Reflection

One of my favorite features I developed was the ability to generate a random activity that matched the responses given for the 3 question survey on the main page. If you wanted to see another you simply pressed the button and another random activity matching those attributes would be selected and displayed. With more time I would have liked to fill the DB with more options, and also add a little stopper to prevent showing the same activity twice. I would have implemented this by simply storing the current activityID in a var, and upon randomly generating a new one checking if they matched, continually getting a new random activity until the IDs did not match.

We presented at the UVM CS Fair in Fall 2020, and while we didn't place, I was very greatful for the learning experience at presenting my work to an unknown group and receiving feedback. As is always true, often a complete set of fresh eyes can come up with questions that may have eluded the design team during the project (especially with a smaller design team where there are less POVs to pull from).
