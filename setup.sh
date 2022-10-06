#!/bin/sh

VENDOR_DIR="$PWD/vendor"
NODE_MODULES_DIR="$PWD/node_modules"

app(){

    if [ ! -d "$VENDOR_DIR" ]; then
        setup()
    fi

    COMMAND=$1

    if [ -z "$COMMAND" ]
    then
        print_help
        return 0;
    fi

    case $COMMAND in
        setup)
        setup
        ;;
        start)
        start_server
        ;;
        exec)
        execute($2)
        ;;
        update)
        run_composer update
        ;;
        help)
        print_help
        ;;
        *)
        echo "No such command: $COMMAND"
        echo ""
        print_commands
        ;;
    esac
}

print_help(){
    echo "Commands:"
    echo "  setup     Setup enviroment"
    echo "  start     Serve laravel and react app"
    echo "  exec      Run custom command on container"
    echo "  help      Show usage help"
    echo ""
}

setup(){
    IS_RUNNIGN=$(docker container ls | grep "facebook_app")
}

app $1
