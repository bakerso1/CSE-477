<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/28/2017
 * Time: 5:03 PM
 */

namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);

        if(isset($post['id']) && isset($post['rating'])) {
            $rating = strip_tags($post['rating']);
            $id = strip_tags($post['id']);

            $newMovie = new Movies($this->site);
            $getMovie = $newMovie->get($user, $id);

            if ($getMovie === null) {
                $this->result = json_encode(array('ok' => false, 'message' => 'Failed to update database!'));
                return;
            }
            $newMovie->updateRating($user, $id, $rating);
        }

        $view = new HomeView($site, $user);
        $this->result = json_encode(array('ok' => true, 'table' => $view->presentTable()));

    }

}