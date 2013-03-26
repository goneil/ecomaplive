<!-- parameters to be set:
    $title
    $backText
    $backHref
    $addText
    $addHref
    $addPlotHref
    $addPlotText
    $settingsText
    $listProjects
    $listMaps
    $contentsLink
-->
<script type="text/javascript" src="/images/js/search-template.js"></script>
<div id="container">
    <div id="container-header">
        <div id="last">
            <?php if (isset($backHref)) { ?>
            <button id="back-button" class="button header-button">
                <?php
                    if (isset($backHref)){
                        echo "<a href=$backHref></a>";
                    }
                    echo $backText;
                ?>
            </button>
            <?php } ?>
        </div>
        <div id="container-title">
            <?php echo $title;?>
        </div>

        <div class="button-container">
            <?php if (isset($addHref)){ ?>

                <button class="header-button button" id="add" onclick="addMap()">
                        <?php
                            echo "<a href=$addHref></a>";
                            echo $addText;
                        ?>
                </button>
            <?php } if (isset($addPlotHref)){ ?>
                <button class="header-button button" id="add-plot"
                onclick="addPlot()">
                    <?php
                        echo "<a href=$addPlotHref></a>";
                        echo $addPlotText;
                    ?>
                </button>
            <?php } if (isset($settingsHref)){ ?>
            <button class="header-button button" id="settings">
                <?php 
                    if (isset($settingsHref)){
                        echo "<a href=$settingsHref></a>";
                    }
                    echo $settingsText;
                ?>
            </button>
            <?php } ?>
        </div>
    </div>
    <div id="container-body">
        <?php if ($search){ ?>
            <div id="search-container">
                <form id="search">
                    <div>
                        <input id="search-box" name="search-box"
                        placeholder="search" value type="text">
                        <button id="search-button"></button>
                    </div>
                </form>
            </div>
            <ul id="search-content">
                <?php
                    if ($listProjects){
                        $projs = getUserProjects($userInfo['uid']);
                        show_project_list($projs);
                    }
                    else if($listMaps){
                        $project = new Project($request[1]);
                        $maps = $project->getMaps();
                        show_map_list($maps);
                    }
                ?>
            </ul>
        <?php } else if($settings){ ?>
            <div id="projectInfo">
                <form method="POST" >
                    <div>
                        Name: <input name="name" value="<?php echo $name;?>"/><br/>
                    </div>
                    <div>
                        Description:<br/>
                        <textarea name="description"><?php echo $description; ?></textarea><br/>
                    </div>
                    <div>
                    Blurb:<br/>
                        <textarea name="blurb"><?php echo $blurb; ?></textarea><br/>
                    </div>
                    <div>
                        Users:
                        <?php 
                            $users = $project->getUsers();
                            echo "<ul>";
                            foreach ($users as $user) {
                                $u = new User($user);
                                $info = $u->getInfo();
                                echo "<li>";
                                echo $info['name'];
                                echo "</li>";
                            }
                            echo "</ul>";
                        ?>

                    </div>
                    <input type="submit" name='save' value="Submit"/>
                </form>
            </div>
            <div id="deleteProject">
                <button id="delete" onclick="deleteFunc();">Delete Project</button>
            </div>
        <?php }else { 
            include($contentsLink);
            }
        ?>
    </div>
</div>
