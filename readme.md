# **Project Overview**  
Welcome to the Hogwarts Student Management System , an innovative platform that blends student management with e-commerce functionality. Designed through a creative and immersive storyline , this project makes learning more engaging and productive.
This project is built entirely using PHP (no frameworks) and follows the MVC pattern within a monolithic architecture .

## **A New Era at Hogwarts**  

### **The Story**  
After the fall of the Dark Lord, Hogwarts entered a new era of **innovation and modernization**. Under **Professor McGonagall’s leadership**, the wizarding world embraced new ideas, blending ancient magic with modern technology.  

As part of this transformation, Hogwarts introduced a groundbreaking subject: **Programming**. Now, young witches and wizards can master the art of coding alongside their magical studies.  

You are among the first graduates of this **new-age Hogwarts curriculum**, and as your final challenge, **Professor McGonagall** has assigned your team a critical task:  

> **Develop an advanced system to manage students, houses, courses, and magical items to ensure Hogwarts remains the finest school of witchcraft and wizardry for generations to come.**  

Even the wizarding world needs a **digital upgrade**!  

## Advanced Features

- Use 3 triggers for : 
  - Update earned points for a student after submitting a quiz , done by comparing their answers with the correct answers.
  - Update the img field in the User entity with an image corresponding to the house they were selected into (e.g., user1.png if house.id = 1), which changes the color of the cat's jacket.
  - Update house points whenever one of its students submits a quiz, so we can determine which house has the most points.
- use some usefull pakages like (respect/validation-JWT-vlucas/phpdotenv-symfony)
- Use Supabase as a PostgreSQL-based serverless backend for secure storage and auto-scaling capabilities. 
- Implement ORM methods like:
getAll(), getOne(), insert(), update(), delete(), getWithJoin(), getWith2Joins()
inside the Database class : [Database.php](app/Core/Database.php)
- Make awesome helper methods you can see it here [FunctionClass](helpers/Functions.php)
- Apply routing system and middelware for (guest,student,professor,headmster)
---

## **Basic Features**  

### 🏰 **House Assignment**  
- **Sorting Hat Magic** 🧙‍♂️  
  - When a new student registers, the **Sorting Hat** assigns them to one of the four houses:  
    - 🦁 **Gryffindor**  
    - 🐍 **Slytherin**  
    - 🦅 **Ravenclaw**  
    - 🦡 **Hufflepuff**  
- **House Points System**  
  - Students earn points based on **course performance** and challenges. *(A quiz or similar challenge can determine points.)*  

### 📚 **Magical Course Enrollment**  
- **Course Options**  
  - Students can enroll in subjects like:  
    - 🛡 **Defense Against the Dark Arts**  
    - 🧪 **Potions**  
    - ✨ **Transfiguration**  
    - 📖 **Charms**  
- **Interactive Quizzes**  
  - Completing quizzes successfully **earns house points**.  
- **Professor Bonus**  
  - Each course is led by a professor who assigns tasks and quizzes, offering an **extra +5 points per course**.  

### ✨ **Wand Selection & Magical Items**  
- **Wand Assignment**  
  - Upon registration, students receive a **random wand** from Ollivander’s Wand Shop.  
  - *Wand Attributes:*  
    - **Wood Types:** Holly, Yew, Elder, Willow, Hawthorn, Oak  
    - **Core Types:** Phoenix Feather, Dragon Heartstring, Unicorn Hair, Thestral Tail Hair  
- **Magical Items & E-Commerce Store**  
  - Students can **collect or purchase** brooms, potion ingredients, spell books, and other magical items as they progress.  

### 🎓 **Admin Dashboard (For Professors & Headmaster)**  
- **Student & Course Management**  
  - Professors can 
    - **create new course which will be assigned to them only**.  
    - **manage students, make quizzes, and add magical items**.  
- **Full Administrative Control**  
  - **Dumbledore(headmaster)** has **ultimate authority**, capable of overriding any professor’s actions if needed.  
    - can appoint student to professor or retire the professor.
    - can edit professors data or make new courses to them  


### There are some screenshots form website 
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130146/32_eyvw2s.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130148/33_u3sp8b.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130138/22_ge6evf.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130144/30_tqx7zs.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130145/31_fqfglg.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130143/29_vilgaf.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130067/1_t682sn.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130106/15_asgquh.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130107/2_piy7g5.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130144/3_qzutkr.png)
![](https://res.cloudinary.com/dweffiohi/image/upload/v1746130151/4_sf5x7i.png)

if you want to see more vist this [Link](https://drive.google.com/drive/folders/1J3s4oHFzddSGnMe_z5nAaLsMus6UVnvt?usp=sharing)
---

## **Installation & Setup**  
*(To be added)*  

```mermaid
erDiagram

    users {
        int4 id PK
        varchar name
        varchar email
        varchar password
        varchar role
        int4 house_id FK
        int4 wand_id FK
        timestamp created_at
        int4 money
        varchar img
    }

    houses {
        int4 id PK
        varchar name
        int4 points
    }

    courses {
        int4 id PK
        varchar name
        int4 user_id FK
        text description
        timestamp created_at
        varchar img
    }

    quizzes {
        int4 id PK
        int4 course_id FK
        text question
        text correct_answer
        int4 points
        timestamp created_at
    }

    student_quizzes {
        int4 id PK
        int4 quiz_id FK
        int4 user_id FK
        text answer
        int4 earned_points
        timestamp created_at
    }

    enrollments {
        int4 id PK
        int4 user_id FK
        int4 course_id FK
        int4 grade
        timestamp created_at
        varchar quiz_finish
    }

    purchases {
        int4 id PK
        int4 user_id FK
        int4 item_id FK
        timestamp created_at
    }

    owls {
        int4 id PK
        int4 sender_id FK
        int4 receiver_id FK
        varchar message
        timestamp created_at
    }

    magical_items {
        int4 id PK
        varchar name
        varchar type
        int4 price
        timestamp created_at
        varchar img
    }

    wands {
        int4 id PK
        varchar wood
        varchar core
        timestamp created_at
        varchar img
    }

    users ||--|| houses : "belongs to"
    users ||--|| wands : "has one"
    courses o{--|| users : "created by"
    quizzes |{--|| courses : "belongs to"
    student_quizzes |{--|| quizzes : "answered"
    student_quizzes |{--|| users : "by"
    enrollments |{--|| users : "enrolled"
    enrollments |{--|| courses : "in"
    purchases |{--|| users : "made by"
    purchases |{--|| magical_items : "bought"
    owls o{--o| users : "sent by" 
    owls o{--o| users : "received by" 

```