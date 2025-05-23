<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Remove the specified comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Find the comment
            $comment = Comment::findOrFail($id);

            // Check if the user is authorized to delete the comment
            if (!Auth::guard('admin')->check()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            // Delete the comment
            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting comment: ' . $e->getMessage());
        }
    }
} 