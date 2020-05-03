<?php


class shortcut
{
    /**
     * Creates DIV container for shortcuts
     *
     * @author Kilian Domaratius
     *
     * @param   string  $name
     * @param   string  $link
     * @param   string  $iconPath
     * @return  string
     */
    public function createShortcut ($name, $link, $iconPath = "") {
        $htmlOutput = "";

        $htmlOutput .= "<a class='shortcut-link' href='$link' target='_blank'>";
            $htmlOutput .= "<div class='shortcut col'>";
                $htmlOutput .= "<div class='shortcut-icon no-darkmode' style='background-image: url($iconPath);'></div>";
                $htmlOutput .= "<span class='shortcut-name'>$name</span>";
            $htmlOutput .= "</div>";
        $htmlOutput .= "</a>";

        return $htmlOutput;
    }
}