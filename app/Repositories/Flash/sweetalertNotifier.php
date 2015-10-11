<?php namespace App\Repositories\Flash;

class sweetalertNotifier
{

    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * Create a new flash notifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Flash an information message.
     *
     * @param string $message
     */
    public function info($message)
    {
        $this->message($message, 'info');

        return $this;
    }

    /**
     * Flash a success message.
     *
     * @param  string $message
     * @return $this
     */
    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    /**
     * Flash an error message.
     *
     * @param  string $message
     * @return $this
     */
    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    /**
     * Flash a warning message.
     *
     * @param  string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    /**
     * Flash an overlay modal.
     *
     * @param  string $message
     * @param  string $title
     * @return $this
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);

        $this->session->flash('flash_notification.overlay', true);
        $this->session->flash('flash_notification.title', $title);

        return $this;
    }

    /**
     * Flash a general message.
     *
     * @param  string $message
     * @param  string $level
     * @return $this
     */
    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);

        return $this;
    }
    
    /*
     * Create a flash message
     * 
     * @param string $message
     * @param string $title
     * @param string $type
     * @param string $key
     * 
     *@return void
     * 
     */
    public function create($message,$title,$type='info',$key='flash_notification'){
    	$this->session->flash($key, [
    			'title'=> $title,
    			'message'=>$message,
    			'type'=>$type
    	]);
    }
    
    /*
     * create a information flash message.
     */
    
    public function s_info($message, $title){
    	return $this->create($message, $title, 'info');
    }
    
    /*
     * create a success flash message.
     */
    public function s_success($message,$title){
    	return $this->create($message, $title, 'success');
    }
    
    /*
     * create a error flash message.
     */
    
    public function s_error($message,$title){
    	return $this->create($message, $title, 'error');
    }
    
    /*
     * create a overlay flash message.
     */
    public function s_overlay($message,$title,$type='success'){
    	return $this->create($message, $title, $type,'flash_notification_overlay');
    }
    
    

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        $this->session->flash('flash_notification.important', true);

        return $this;
    }

}
