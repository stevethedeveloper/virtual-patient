<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Feedback Controller
 *
 *
 */
class FeedbackController extends AppController
{

    var $yield_names = array('0' => 'Contraindicated', '4' => 'High Yield', '3' => 'Reasonable Yield', '2' => 'Low Yield', '1' => 'Very Low Yield');
    var $user_id;
    var $case_id;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->user_id = $this->Auth->user()['id'];
        $this->case_id = $this->request->session()->read('case_id');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function study() {
        $data = $this->CustomPages->get_page($this->case_id, 'feedback_study');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $video_path = array();
        $video_path['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/';
        $video_path['http'] = 'http://'.$ios_path.$folder.'/';

        $this->loadModel('UserAnswers');

        $feedback_array = $this->UserAnswers->getFeedbackArray($this->case_id, $this->user_id, 'labs');

        $this->set('yield_names', $this->yield_names);
        $this->set(compact('data', 'page', 'poster', 'feedback_array', 'video_path'));
    }

    public function counseling() {
        $data = $this->CustomPages->get_page($this->case_id, 'feedback_counseling');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $video_path = array();
        $video_path['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/';
        $video_path['http'] = 'http://'.$ios_path.$folder.'/';

        $this->loadModel('UserAnswers');

        $feedback_array = $this->UserAnswers->getFeedbackArray($this->case_id, $this->user_id, 'management_counseling');

        $this->set('yield_names', $this->yield_names);
        $this->set(compact('data', 'page', 'poster', 'feedback_array', 'video_path'));
    }

    public function medication() {
        $data = $this->CustomPages->get_page($this->case_id, 'feedback_medication');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $video_path = array();
        $video_path['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/';
        $video_path['http'] = 'http://'.$ios_path.$folder.'/';

        $this->loadModel('UserAnswers');

        $feedback_array = $this->UserAnswers->getFeedbackArray($this->case_id, $this->user_id, 'management_medication');

        $this->set('yield_names', $this->yield_names);
        $this->set(compact('data', 'page', 'poster', 'feedback_array', 'video_path'));
    }

    public function referral() {
        $data = $this->CustomPages->get_page($this->case_id, 'feedback_referral');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $video_path = array();
        $video_path['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/';
        $video_path['http'] = 'http://'.$ios_path.$folder.'/';

        $this->loadModel('UserAnswers');

        $feedback_array = $this->UserAnswers->getFeedbackArray($this->case_id, $this->user_id, 'management_referral');

        $this->set('yield_names', $this->yield_names);
        $this->set(compact('data', 'page', 'poster', 'feedback_array', 'video_path'));
    }

    public function billing() {
        $data = $this->CustomPages->get_page($this->case_id, 'feedback_billing');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $video_path = array();
        $video_path['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/';
        $video_path['http'] = 'http://'.$ios_path.$folder.'/';

        $this->loadModel('UserAnswers');

        $feedback_array = $this->UserAnswers->getFeedbackArray($this->case_id, $this->user_id, 'billing');

        $this->set('yield_names', $this->yield_names);
        $this->set(compact('data', 'page', 'poster', 'feedback_array', 'video_path'));
    }

}
