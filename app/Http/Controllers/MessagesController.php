<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        //$users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        if (Auth::id() < $user->id ) {
            $users= [Auth::id(), $user->id];
        }else{
            $users= [$user->id, Auth::id()];
        }

        $users= implode('-', $users);
        
        $thread = Thread::firstOrCreate([
            'subject' => $users,
        ]);

        // Sender
        $sender= Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);

        $sender->last_read=  new Carbon;
        $sender->save();
        // Recipients
        
        $thread->addParticipant($user->id);
        
        return redirect()->route('messages.show', $thread->id);//return view('messenger.create', compact('user'));
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        $message= Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Input::get('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        $options = array(
            'cluster' => 'us2',
            'encrypted' => true
        );

        $pusher = new Pusher(
            '52eac2d8a951fbb04113',
            '64707e7975de9cd112a7',
            '520045',
            $options
        );
        $message->user;
        $message['fecha']= $message->created_at->diffForHumans();
        $data['message'] = $message->toArray();

        $pusher->trigger("chat_".$thread->id, 'new-message', $data);
        return response()->json(['status' => $message]);

        //return redirect()->route('messages.show', $id);
    }
}