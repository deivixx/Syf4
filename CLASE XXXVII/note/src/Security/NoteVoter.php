<?php

namespace App\Security;

use App\Entity\Note;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;


class NoteVoter extends Voter {

    // these strings are just invented: you can use anything
    const EDIT = 'edit';
    const DELETE = 'delete';

    private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    protected function supports($attribute, $subject) {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        // only vote on Note objects inside this voter
        if (!$subject instanceof Note) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Note object, thanks to supports
        /** @var Note $note */
        $note = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($note, $user);
            case self::DELETE:
                return $this->canDelete($note, $user);
        }

        throw new \LogicException('ERROR: No estás autorizado para realizar esta acción');
    }

    
    private function canEdit(Note $note, User $user) {

        if ($this->security->isGranted('ROLE_ADMIN') || $user === $note->getUser()) {
            return true;
        }
    }

    private function canDelete(Note $note, User $user) {

        if ($this->security->isGranted('ROLE_ADMIN') || $user === $note->getUser()) {
            return true;
        }
    }

}
