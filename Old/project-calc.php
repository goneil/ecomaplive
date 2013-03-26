<?php
    $basepath = "http://" . $_SERVER['HTTP_HOST'];
    
    $requestString = "";
    foreach($request as $r){
        $requestString = $requestString . " " . $r;
    }

    $requestSize = count($request);
    if ($requestSize === 1){
        $title = "Projects";
        $listProjects = true;
        $addText = "New Project";
        $addHref = "$basepath/project/add";
        $search = true;
    } else if ($requestSize >= 1){
        if ($request[1] === "add"){
        } else{
            $projectNum = $request[1];
            $project = new Project($projectNum);
            if ($request[2] === "settings"){
                if (isset($_POST['save'])){
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $blurb = $_POST['blurb'];
                    $project->edit($name, $description, $blurb);
                } else if (isset($_POST['delete'])){
                    $project->remove();
                    header("Location: $basepath/project");
                }
                $settings = true;
                $title = $project->getName() . " Settings";
                $backText = $project->getName();
                $backHref = "$basepath/project/" . $projectNum;
                $name = $project->getName();
                $description = $project->getDescription();
                $blurb = $project->getBlurb();
                $users = $project->getUsers();
            } else{
                $title = $project->getName();
                $backText = "Projects";
                $backHref = "$basepath/project";
                $listMaps = true;
                $addText = "New Map";
                $addHref = "$basepath/create_map";
                $addPlotText = "New Plot";
                $addPlotHref = "$basepath/create_plot";
                $search = true;
            }
            $settingsHref = "$basepath/project/$request[1]/settings";
            $settingsText = "settings";
        }
    }

?>

