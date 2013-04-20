<?php

namespace Workshop\LessonOneBundle\Listener;
use Workshop\MainBundle\Menu\Event\BuildMenuEvent;

class BuildMenuListener {

	public function onBuildMainMenu(BuildMenuEvent $event) {
		$menu = $event->getMenu();

		$lessonOne = $menu->addChild(
			"Lesson One",
			array("route" => "workshop_lessonOne_default_index")
		);

	}
}