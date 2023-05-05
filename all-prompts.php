<?php
    include_once 'header.php'

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>All prompts</title>
</head>
<body>

<aside>
    <div id="filters">
        <div class="titlesFilters">Sort by</div>
        <ul>
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Hottest   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Top   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Newest   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Oldest   
                </label>
            </li>

        </ul>

        <div class="titlesFilters">Model</div>
        <ul>
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    All   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    DALL-E   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Midjourney   
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    ChatGPT   
                </label>
            </li>
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Stable Diffusion   
                </label>
            </li>

        </ul>

        <div class="titlesFilters">Category</div>
        <ul>
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    All
                </label>
            </li>
            
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    3D
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Accesory
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Ads
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Animal
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Anime
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Art
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Avatar
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Building
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Business
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Cartoon
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Chatbot
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Clothes
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Coach
                </label>
            </li>
                    
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Code
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Conversion
                </label>
            </li>
                    
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Copy
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Cute
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Drawing
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Email
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Fantasy
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Fashion
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Finance
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Fix
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Food
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Fun
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Funny
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Future
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Games
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Generation
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Graphic Design
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Health
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Icons
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Ideas
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Illustration
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Landscape
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Language
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Logo
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Marketing
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Mockup
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Monogram
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Music
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Nature
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    NSFW
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Paiting
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Pattern
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    People
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Photography
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Pixel Art
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Plan
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Product
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Prompts
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Psychedelic
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Scary
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Seo
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Social
                </label>
            </li>
                    
            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Space
                </label>
            </li>


            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Sport
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Study
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Unique Style
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Summarise
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Synthwave
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Translate
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Travel
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Vehicle
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Wallpaper
                </label>
            </li>

            <li>
                <label>
                    <input type="checkbox" class="checkbox" name="sort" unchecked>
                    Writing
                </label>
            </li>
        </ul>
    </div>
</aside>

</body>
</html>