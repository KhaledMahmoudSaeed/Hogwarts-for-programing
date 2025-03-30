<div id="homepage" class="<?php echo $newUser ? 'hidden' : ''; ?>">
        <!-- <h1>Welcome to Hogwarts!</h1>
        <p>Your magical journey begins here.</p>
        <?php print_r($_SESSION); ?> -->
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="hero-overlay">
                <h1>Welcome to Hogwarts</h1>
                <p>Where magic thrives and legends are born.</p>
                <button class="btn"><a href="#houses"><i class="fa-solid fa-circle-chevron-down"></i></a></button>
            </div>
        </section>

        <!-- Houses Section -->
        <section id="houses" class="houses">
            <h2>Our Houses</h2>
            <div class="house-container">
                <div class="house">
                    <img src="../resources/assets/img/gryffindor-flag.png" alt="Gryffindor">
                    <h3>Gryffindor</h3>
                    <p>Brave, daring, and chivalrous—Gryffindors value courage and determination.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/slytherin-flag.png" alt="Slytherin">
                    <h3>Slytherin</h3>
                    <p>Cunning, ambitious, and resourceful—Slytherins strive for greatness.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/ravenclaw-flag.png" alt="Ravenclaw">
                    <h3>Ravenclaw</h3>
                    <p>Wise, creative, and intellectual—Ravenclaws prize knowledge and wit.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/hufflepuff-flag.png" alt="Hufflepuff">
                    <h3>Hufflepuff</h3>
                    <p>Loyal, patient, and hardworking—Hufflepuffs value fairness and dedication.</p>
                </div>
            </div>
        </section>

        <!-- Activities Section -->
        <section id="activities" class="activities">
            <h2>Magical Activities</h2>
            <div class="activities-container">
                <div class="activity">
                    <h3>Quidditch</h3>
                    <p>Soar on broomsticks and cheer as the houses compete in the exhilarating sport of Quidditch.</p>
                </div>
                <div class="activity">
                    <h3>Triwizard Tournament</h3>
                    <p>Witness daring challenges and magical duels as champions from different schools prove their
                        mettle.</p>
                </div>
                <div class="activity">
                    <h3>Potions & Spells</h3>
                    <p>Explore the art of potion-making and spell-casting under the guidance of legendary professors.
                    </p>
                </div>
            </div>
        </section>
    </div>