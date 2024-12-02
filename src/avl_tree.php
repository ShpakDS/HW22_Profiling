<?php

class Node
{
    public $key;
    public $left;
    public $right;
    public $height;

    public function __construct($key)
    {
        $this->key = $key;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}

class AVLTree
{
    private function height($node)
    {
        return $node ? $node->height : 0;
    }

    private function getBalance($node)
    {
        return $node ? $this->height($node->left) - $this->height($node->right) : 0;
    }

    private function rotateRight($y)
    {
        $x = $y->left;
        $T2 = $x->right;

        $x->right = $y;
        $y->left = $T2;

        $y->height = max($this->height($y->left), $this->height($y->right)) + 1;
        $x->height = max($this->height($x->left), $this->height($x->right)) + 1;

        return $x;
    }

    private function rotateLeft($x)
    {
        $y = $x->right;
        $T2 = $y->left;

        $y->left = $x;
        $x->right = $T2;

        $x->height = max($this->height($x->left), $this->height($x->right)) + 1;
        $y->height = max($this->height($y->left), $this->height($y->right)) + 1;

        return $y;
    }

    public function insert($node, $key)
    {
        if (!$node) {
            return new Node($key);
        }

        if ($key < $node->key) {
            $node->left = $this->insert($node->left, $key);
        } elseif ($key > $node->key) {
            $node->right = $this->insert($node->right, $key);
        } else {
            return $node; // No duplicates allowed
        }

        $node->height = 1 + max($this->height($node->left), $this->height($node->right));
        $balance = $this->getBalance($node);

        // Left Left Case
        if ($balance > 1 && $key < $node->left->key) {
            return $this->rotateRight($node);
        }

        // Right Right Case
        if ($balance < -1 && $key > $node->right->key) {
            return $this->rotateLeft($node);
        }

        // Left Right Case
        if ($balance > 1 && $key > $node->left->key) {
            $node->left = $this->rotateLeft($node->left);
            return $this->rotateRight($node);
        }

        // Right Left Case
        if ($balance < -1 && $key < $node->right->key) {
            $node->right = $this->rotateRight($node->right);
            return $this->rotateLeft($node);
        }

        return $node;
    }

    public function search($node, $key)
    {
        if (!$node || $node->key == $key) {
            return $node;
        }

        if ($key < $node->key) {
            return $this->search($node->left, $key);
        }

        return $this->search($node->right, $key);
    }

    public function delete($node, $key) {
        if (!$node) {
            return $node;
        }

        if ($key < $node->key) {
            $node->left = $this->delete($node->left, $key);
        } elseif ($key > $node->key) {
            $node->right = $this->delete($node->right, $key);
        } else {
            if (!$node->left || !$node->right) {
                $node = $node->left ?: $node->right;
            } else {
                $minLargerNode = $this->getMin($node->right);
                $node->key = $minLargerNode->key;
                $node->right = $this->delete($node->right, $minLargerNode->key);
            }
        }

        if (!$node) {
            return $node;
        }

        $node->height = 1 + max($this->height($node->left), $this->height($node->right));
        $balance = $this->getBalance($node);

        if ($balance > 1 && $this->getBalance($node->left) >= 0) {
            return $this->rotateRight($node);
        }

        if ($balance > 1 && $this->getBalance($node->left) < 0) {
            $node->left = $this->rotateLeft($node->left);
            return $this->rotateRight($node);
        }

        if ($balance < -1 && $this->getBalance($node->right) <= 0) {
            return $this->rotateLeft($node);
        }

        if ($balance < -1 && $this->getBalance($node->right) > 0) {
            $node->right = $this->rotateRight($node->right);
            return $this->rotateLeft($node);
        }

        return $node;
    }

    private function getMin($node) {
        while ($node->left) {
            $node = $node->left;
        }
        return $node;
    }
}