#!/bin/sh
php yii migrate/up --interactive=0
php yii cache/flush-all
php yii cache/flush-schema --interactive=0