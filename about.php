<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF‐8"/>
    <meta name="description" content="Developer About Page"/>
    <meta name="keywords" content="about, fitness, membership"/>
    <meta name="author"   content="Sophie Nadine Jacobs" />
    <title>About | Kardio Kings & Queens</title>

    <link rel="icon" type="image/x-icon" href="images/favicon.png"> <!--ttps://www.flaticon.com/free-icons/muscle: Muscle icons created by Dragon Icons - Flaticon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <link href = "styles/style.css" rel = "stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 995px)" href="styles/responsive.css">

    <script src="scripts/menu.js"></script>
</head>
<body>
<?php
    include "includes/header.inc";
?>
    <article>
        <h2 id = "aboutHeader">Get to Know me</h2>
        <section id = "aboutContainer">
            <dl>
                <dt>Name:</dt>
                <dd>Sophie Nadine Jacobs</dd>
                <dt>Course:</dt>
                <dd>Bachelor of Computer Science</dd>
                <dt>Email:</dt>
                <dd><a href = "mailto:sophiejcb1890@gmail.com">sophiejcb1890@gmail.com</a></dd>
            </dl>
            
            <figure>
                <img id = "myPhoto" src = "images/myPhoto.png" alt = "Photo of me (Sophie Nadine Jacobs)"/>
            </figure>
        </section>
        <p id = "demoInfo">
            Hello, my name is Sophie! I am a 20 year old Malaysian girl that is studying in INTI International College Subang for my higher education.
            I am a Final Year student, and I previously completed a Diploma in Computer Science with a specialization in Data Analytics in INTI Subang.
            Through this experience, I found Data Analytics a very interesting area to explore and learn more about, which is why I also chose Data Science as the major for my degree.
        </p>
        
        <h4 class = "aboutSubheader">Interests</h4>
        <section id = "interestsContainer">
            <p id = "detailsAndSummary">Things I love to do:</p>
            <details>
                <summary>Reading books & comics</summary>
                <p class = "details">One of my top interests include reading books and comics. I always get deeply invested and immersed in them, and experience an emotional rollercoaster alongside the characters as they are put in the face of adversity. My favourite genres include drama, romance, romantic comedy, comedy, and adventure, with themes of friendships, self-discovery, and finding one's passion/purpose intertwined into the story.
                    What I find most captivating about a book or comic is the development and growth a character gains with every tough obstacle they face. 
                    I especially enjoy reading about characters that do not give up no matter how tough their situation gets, no matter how many people do not believe in them, and no matter how much the odds are stacked against them.
                    It inspires me to do the best I can in everything I do, and to make the most out of life.</p>
            </details>
            <details>
                <summary>Watching TV shows & movies</summary>
                <p class = "details">Moving on, similar to my passion for books and comics, I also am an avid fan of TV shows & movies because of how enraptured I can get by the characters and storyline. I enjoy watching dramas and comedies, 
                    movies and TV shows that are heart-warming and inspiring, as well as shows that have complex story-telling and realistic themes.
                   I also do enjoy a fair share of TV sitcoms, such as "Modern Family", "Schitt's Creek", "Superstore", "Parks & Recreations", "Community", and more. 
                </p>
            </details>
            <details>
                <summary>Programming</summary>
                <p class = "details">Finally, I also love programming. I find it very fun and engaging, as it challenges me in how I can solve a number of problems using code. It also feels very rewarding when I can successfully run and test my final program after hours of time and effort. I enjoy exploring different concepts or functions in a particular programming language, especially when I can discover more efficient and better ways to perform a certain task.
                   Although the major for my Computer Science degree is in Data Science, I also do enjoy Software Development due to my enjoyment of programming. My favourite programming languages include Python, Java, and JavaScript. I hope that I can keep improving in my programming skills.
                </p>
            </details>
            <br><br>
        </section>
    </article>
<?php
    include "includes/footer.inc";
?>
    <br>
</body>
</html>