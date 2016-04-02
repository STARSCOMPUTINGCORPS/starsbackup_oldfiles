#!/usr/bin/env python

"""
Colorama formatting options:

Fore: BLACK, RED, GREEN, YELLOW, BLUE, MAGENTA, CYAN, WHITE, RESET.
Back: BLACK, RED, GREEN, YELLOW, BLUE, MAGENTA, CYAN, WHITE, RESET.
Style: DIM, NORMAL, BRIGHT, RESET_ALL

"""
import sys
import os
import colorama
from colorama import Fore, Back, Style


def set_title(title_string):
    """Sets the title of the terminal"""

    control_code = "\033]0;{}\007".format(title_string)
    sys.stdout.write(control_code)


def venv():
    """Returns the current venv, if there is one"""

    virtual_environment = ""
    if "VIRTUAL_ENV" in os.environ:
        venv_path = os.environ.get("VIRTUAL_ENV")
        venv_base_dir = os.path.basename(venv_path)
        virtual_environment = "{}({})".format(Fore.MAGENTA, venv_base_dir)
    return virtual_environment


def super_user_identifier():
    """Returns the character to appear at the end of the Terminal prompt."""

    return Fore.BLUE + r"\$"

def reset_terminal_formatting():
    """Returns the reset for for Colorama's Fore, Back, and Style."""

    return Fore.RESET + Back.RESET + Style.RESET_ALL

if __name__ == '__main__':
    colorama.init()
    # Set the Terminal title.
    title = os.path.basename(os.getcwd())
    set_title(title)
    # Set the Terminal command prompt (PS1).
    prompt_list = []
    prompt_list.append(venv())
    prompt_list.append(super_user_identifier())
    prompt_list.append(reset_terminal_formatting())
    prompt_str = "".join(prompt_list)
    sys.stdout.write(prompt_str)
